<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Dashboard",
 *     description="API Endpoints untuk dashboard statistics"
 * )
 */
class DashboardApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/dashboard/user",
     *     tags={"Dashboard"},
     *     summary="Get user dashboard data",
     *     description="Mendapatkan data dashboard untuk user (latest jobs)",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="latest_jobs", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="Software Engineer"),
     *                     @OA\Property(property="company", type="string", example="Tech Corp"),
     *                     @OA\Property(property="location", type="string", example="Jakarta"),
     *                     @OA\Property(property="salary", type="string", example="10000000-15000000"),
     *                     @OA\Property(property="job_type", type="string", example="Full Time")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function userDashboard()
    {
        $latestJobs = JobVacancy::latest()
            ->where('is_active', true)
            ->take(5)
            ->get();

        return response()->json([
            'latest_jobs' => $latestJobs,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/dashboard/admin",
     *     tags={"Dashboard"},
     *     summary="Get admin dashboard statistics (Admin only)",
     *     description="Mendapatkan statistik dashboard untuk admin",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="statistics", type="object",
     *                 @OA\Property(property="total_jobs", type="integer", example=50),
     *                 @OA\Property(property="active_jobs", type="integer", example=35),
     *                 @OA\Property(property="total_users", type="integer", example=100),
     *                 @OA\Property(property="total_applications", type="integer", example=150),
     *                 @OA\Property(property="pending_applications", type="integer", example=20)
     *             ),
     *             @OA\Property(property="latest_jobs", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="Software Engineer"),
     *                     @OA\Property(property="company", type="string", example="Tech Corp"),
     *                     @OA\Property(property="applications_count", type="integer", example=10)
     *                 )
     *             )
     *         )
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
    public function adminDashboard(Request $request)
    {
        // Check if user is admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Forbidden. Admin access required.',
            ], 403);
        }

        // Get statistics
        $totalJobs = JobVacancy::count();
        $activeJobs = JobVacancy::where('is_active', true)->count();
        $totalUsers = User::where('role', 'user')->count();
        $totalApplications = Application::count();
        $pendingApplications = Application::where('status', 'pending')->count();

        // Get latest jobs with application count
        $latestJobs = JobVacancy::withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'statistics' => [
                'total_jobs' => $totalJobs,
                'active_jobs' => $activeJobs,
                'total_users' => $totalUsers,
                'total_applications' => $totalApplications,
                'pending_applications' => $pendingApplications,
            ],
            'latest_jobs' => $latestJobs,
        ]);
    }
}
