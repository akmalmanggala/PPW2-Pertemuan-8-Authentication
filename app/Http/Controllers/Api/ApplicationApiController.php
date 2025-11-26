<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendApplicationMailJob;
use App\Models\Application;
use App\Models\JobVacancy;
use App\Models\User;
use App\Notifications\NewApplicationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

/**
 * @OA\Tag(
 *     name="Applications",
 *     description="API Endpoints untuk job applications"
 * )
 */
class ApplicationApiController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/applications",
     *     tags={"Applications"},
     *     summary="Apply for a job",
     *     description="Melamar pekerjaan dengan upload CV",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"job_id","cv"},
     *                 @OA\Property(property="job_id", type="integer", example=1),
     *                 @OA\Property(property="cv", type="string", format="binary", description="PDF file only")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Application submitted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Application submitted successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="job_id", type="integer", example=1),
     *                 @OA\Property(property="cv", type="string", example="cvs/cv_123456.pdf"),
     *                 @OA\Property(property="status", type="string", example="pending")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Already applied or validation error"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Job not found"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:job_vacancies,id',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Check if job exists and is active
        $job = JobVacancy::find($request->job_id);
        if (!$job || !$job->is_active) {
            return response()->json([
                'message' => 'Job not found or not active',
            ], 404);
        }

        // Check if user already applied
        $existingApplication = Application::where('user_id', $request->user()->id)
            ->where('job_id', $request->job_id)
            ->first();

        if ($existingApplication) {
            return response()->json([
                'message' => 'You have already applied for this job',
            ], 400);
        }

        // Upload CV
        $cvPath = $request->file('cv')->store('cvs', 'public');

        // Create application
        $application = Application::create([
            'user_id' => $request->user()->id,
            'job_id' => $request->job_id,
            'cv' => $cvPath,
            'status' => 'pending',
        ]);

        // Send email notification to user (async)
        SendApplicationMailJob::dispatch($application);

        // Notify all admins
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewApplicationNotification($application));

        return response()->json([
            'message' => 'Application submitted successfully',
            'data' => $application,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/applications",
     *     tags={"Applications"},
     *     summary="Get list of applications (Admin only)",
     *     description="Mendapatkan daftar semua aplikasi lamaran",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter by status",
     *         required=false,
     *         @OA\Schema(type="string", enum={"pending", "accepted", "rejected"})
     *     ),
     *     @OA\Parameter(
     *         name="job_id",
     *         in="query",
     *         description="Filter by job ID",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden - Admin only"
     *     )
     * )
     */
    public function index(Request $request)
    {
        // Check if user is admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Forbidden. Admin access required.',
            ], 403);
        }

        $perPage = $request->input('per_page', 10);

        $query = Application::with(['user', 'jobVacancy']);

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by job_id
        if ($request->has('job_id')) {
            $query->where('job_id', $request->job_id);
        }

        $applications = $query->latest()->paginate($perPage);

        return response()->json($applications);
    }

    /**
     * @OA\Patch(
     *     path="/api/applications/{id}/status",
     *     tags={"Applications"},
     *     summary="Update application status (Admin only)",
     *     description="Mengupdate status aplikasi lamaran (accepted/rejected)",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Application ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *             @OA\Property(property="status", type="string", enum={"accepted", "rejected"}, example="accepted")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Status updated successfully"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden - Admin only"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Application not found"
     *     )
     * )
     */
    public function updateStatus(Request $request, $id)
    {
        // Check if user is admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Forbidden. Admin access required.',
            ], 403);
        }

        $application = Application::find($id);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found',
            ], 404);
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $application->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Application status updated successfully',
            'data' => $application,
        ]);
    }
}
