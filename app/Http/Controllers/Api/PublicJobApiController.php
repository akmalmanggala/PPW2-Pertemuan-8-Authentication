<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Public Jobs",
 *     description="API Endpoints untuk public jobs (tanpa autentikasi)"
 * )
 */
class PublicJobApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/public/jobs",
     *     tags={"Public Jobs"},
     *     summary="Get public job listings (No authentication required)",
     *     description="Mendapatkan daftar lowongan pekerjaan publik tanpa memerlukan token autentikasi. Endpoint read-only untuk akses publik.",
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search by title, company, or description",
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
     *         description="Filter by company name",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="job_type",
     *         in="query",
     *         description="Filter by job type",
     *         required=false,
     *         @OA\Schema(type="string", enum={"Full Time", "Part Time", "Contract", "Freelance"})
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", default=1, example=2)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=10, example=5)
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
     *                     @OA\Property(property="description", type="string", example="Job description...")
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=2),
     *             @OA\Property(property="per_page", type="integer", example=5),
     *             @OA\Property(property="total", type="integer", example=50),
     *             @OA\Property(property="last_page", type="integer", example=10)
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        // Custom pagination parameters
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        // Start query - only active jobs
        $query = JobVacancy::query()->where('is_active', true);

        // Search functionality (title, company, description)
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('company', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by location
        if ($request->has('location') && $request->location) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by company
        if ($request->has('company') && $request->company) {
            $query->where('company', 'like', '%' . $request->company . '%');
        }

        // Filter by job type
        if ($request->has('job_type') && $request->job_type) {
            $query->where('job_type', $request->job_type);
        }

        // Paginate results with custom parameters
        $jobs = $query->latest()->paginate($perPage, ['*'], 'page', $page);

        return response()->json($jobs);
    }

    /**
     * @OA\Get(
     *     path="/api/public/jobs/{id}",
     *     tags={"Public Jobs"},
     *     summary="Get public job detail (No authentication required)",
     *     description="Mendapatkan detail lowongan pekerjaan tanpa memerlukan token autentikasi",
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
     *             @OA\Property(property="logo", type="string", example="logos/company-logo.png")
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
        $job = JobVacancy::where('is_active', true)->find($id);

        if (!$job) {
            return response()->json([
                'message' => 'Job not found or not active',
            ], 404);
        }

        return response()->json($job);
    }
}
