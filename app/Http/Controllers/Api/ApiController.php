<?php

namespace App\Http\Controllers\Api;

/**
 * @OA\Info(
 *     title="Job Portal API",
 *     version="1.0.0",
 *     description="API untuk aplikasi Job Portal - Pertemuan 6 PPW2",
 *     @OA\Contact(
 *         email="akmalmanggala2810@gmail.com",
 *         name="Akmal Manggala Putra"
 *     )
 * )
 *
 * @OA\Server(
 *     url="http://127.0.0.1:8000",
 *     description="Local Development Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Enter your bearer token in the format: Bearer {token}"
 * )
 */
class ApiController
{
    // This is just a placeholder for Swagger annotations
}
