<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Jobs User",
 *     description="API Endpoints untuk user melihat dan search job vacancies"
 * )
 */
class JobUserApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/user/jobs",
     *     tags={"Jobs User"},
     *     summary="Get list of jobs for user with advanced search",
     *     description="Mendapatkan daftar lowongan pekerjaan aktif dengan fitur search, filter, dan sorting",
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
     *         name="job_type",
     *         in="query",
     *         description="Filter by job type (can be multiple)",
     *         required=false,
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(type="string", enum={"Full Time", "Part Time", "Contract", "Freelance"})
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Sort results",
     *         required=false,
     *         @OA\Schema(type="string", enum={"latest", "oldest", "salary_high", "salary_low"}, default="latest")
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
     *                     @OA\Property(property="description", type="string", example="Job description...")
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

        // Start query builder - only active jobs
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

        // Location filter
        if ($request->has('location') && $request->location) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Job type filter (can be multiple values)
        if ($request->has('job_type')) {
            $jobTypes = is_array($request->job_type) ? $request->job_type : [$request->job_type];
            if (count($jobTypes) > 0) {
                $query->whereIn('job_type', $jobTypes);
            }
        }

        // Sorting
        switch ($request->input('sort', 'latest')) {
            case 'oldest':
                $query->oldest();
                break;
            case 'salary_high':
                $query->orderBy('salary', 'desc');
                break;
            case 'salary_low':
                $query->orderBy('salary', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        // Paginate results
        $jobs = $query->paginate($perPage);

        return response()->json($jobs);
    }

    /**
     * @OA\Get(
     *     path="/api/user/jobs/{id}",
     *     tags={"Jobs User"},
     *     summary="Get job detail for user",
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
     *             @OA\Property(property="logo", type="string", example="logos/company-logo.png"),
     *             @OA\Property(property="is_active", type="boolean", example=true),
     *             @OA\Property(property="created_at", type="string", format="date-time")
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
}
