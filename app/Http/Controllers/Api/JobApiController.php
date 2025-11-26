<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Tag(
 *     name="Jobs",
 *     description="API Endpoints untuk job vacancies"
 * )
 */
class JobApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/jobs",
     *     tags={"Jobs"},
     *     summary="Get list of job vacancies",
     *     description="Mendapatkan daftar lowongan pekerjaan dengan fitur search dan pagination",
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search by title or company",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="location",
     *         in="query",
     *         description="Filter by location",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="company",
     *         in="query",
     *         description="Filter by company",
     *         required=false,
     *         @OA\Schema(type="string")
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
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="Software Engineer"),
     *                     @OA\Property(property="company", type="string", example="Tech Corp"),
     *                     @OA\Property(property="location", type="string", example="Jakarta"),
     *                     @OA\Property(property="salary", type="string", example="10000000-15000000"),
     *                     @OA\Property(property="job_type", type="string", example="Full Time"),
     *                     @OA\Property(property="is_active", type="boolean", example=true)
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="per_page", type="integer", example=10),
     *             @OA\Property(property="total", type="integer", example=50)
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $query = JobVacancy::where('is_active', true);

        // Search by title or company
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%");
            });
        }

        // Filter by location
        if ($request->has('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Filter by company
        if ($request->has('company')) {
            $query->where('company', 'like', "%{$request->company}%");
        }

        $jobs = $query->latest()->paginate($perPage);

        return response()->json($jobs);
    }

    /**
     * @OA\Get(
     *     path="/api/jobs/{id}",
     *     tags={"Jobs"},
     *     summary="Get job vacancy detail",
     *     description="Mendapatkan detail lowongan pekerjaan berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Job ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Software Engineer"),
     *             @OA\Property(property="description", type="string", example="Job description..."),
     *             @OA\Property(property="company", type="string", example="Tech Corp"),
     *             @OA\Property(property="location", type="string", example="Jakarta"),
     *             @OA\Property(property="salary", type="string", example="10000000-15000000"),
     *             @OA\Property(property="job_type", type="string", example="Full Time"),
     *             @OA\Property(property="is_active", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Job not found"
     *     )
     * )
     */
    public function show($id)
    {
        $job = JobVacancy::find($id);

        if (!$job) {
            return response()->json([
                'message' => 'Job not found',
            ], 404);
        }

        return response()->json($job);
    }

    /**
     * @OA\Post(
     *     path="/api/jobs",
     *     tags={"Jobs"},
     *     summary="Create new job vacancy (Admin only)",
     *     description="Membuat lowongan pekerjaan baru",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"title","description","location","company","job_type"},
     *                 @OA\Property(property="title", type="string", example="Software Engineer"),
     *                 @OA\Property(property="description", type="string", example="Job description..."),
     *                 @OA\Property(property="location", type="string", example="Jakarta"),
     *                 @OA\Property(property="company", type="string", example="Tech Corp"),
     *                 @OA\Property(property="salary", type="string", example="10000000-15000000"),
     *                 @OA\Property(property="job_type", type="string", enum={"Full Time", "Part Time", "Contract", "Freelance"}),
     *                 @OA\Property(property="logo", type="string", format="binary"),
     *                 @OA\Property(property="is_active", type="boolean", example=true)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Job created successfully"
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
    public function store(Request $request)
    {
        // Check if user is admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Forbidden. Admin access required.',
            ], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'salary' => 'nullable|string|max:255',
            'job_type' => 'required|in:Full Time,Part Time,Contract,Freelance',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $logoPath;
        }

        $job = JobVacancy::create($data);

        return response()->json([
            'message' => 'Job created successfully',
            'data' => $job,
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/jobs/{id}",
     *     tags={"Jobs"},
     *     summary="Update job vacancy (Admin only)",
     *     description="Mengupdate lowongan pekerjaan",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Job ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Software Engineer"),
     *             @OA\Property(property="description", type="string", example="Updated description..."),
     *             @OA\Property(property="location", type="string", example="Jakarta"),
     *             @OA\Property(property="company", type="string", example="Tech Corp"),
     *             @OA\Property(property="salary", type="string", example="10000000-15000000"),
     *             @OA\Property(property="job_type", type="string", enum={"Full Time", "Part Time", "Contract", "Freelance"}),
     *             @OA\Property(property="is_active", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Job updated successfully"
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
     *         description="Job not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        // Check if user is admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Forbidden. Admin access required.',
            ], 403);
        }

        $job = JobVacancy::find($id);

        if (!$job) {
            return response()->json([
                'message' => 'Job not found',
            ], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'location' => 'sometimes|required|string|max:255',
            'company' => 'sometimes|required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'salary' => 'nullable|string|max:255',
            'job_type' => 'sometimes|required|in:Full Time,Part Time,Contract,Freelance',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($job->logo) {
                Storage::disk('public')->delete($job->logo);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $logoPath;
        }

        $job->update($data);

        return response()->json([
            'message' => 'Job updated successfully',
            'data' => $job,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/jobs/{id}",
     *     tags={"Jobs"},
     *     summary="Delete job vacancy (Admin only)",
     *     description="Menghapus lowongan pekerjaan",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Job ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Job deleted successfully"
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
     *         description="Job not found"
     *     )
     * )
     */
    public function destroy(Request $request, $id)
    {
        // Check if user is admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Forbidden. Admin access required.',
            ], 403);
        }

        $job = JobVacancy::find($id);

        if (!$job) {
            return response()->json([
                'message' => 'Job not found',
            ], 404);
        }

        // Delete logo if exists
        if ($job->logo) {
            Storage::disk('public')->delete($job->logo);
        }

        $job->delete();

        return response()->json([
            'message' => 'Job deleted successfully',
        ]);
    }
}
