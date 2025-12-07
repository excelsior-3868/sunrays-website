<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\GalleryAlbumController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\BlogPostController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\InquiryController;
use App\Http\Controllers\Api\SettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Auth
Route::post('/login', [AuthController::class, 'login']);

// Public
Route::get('/pages/{slug?}', [PageController::class, 'getBySlug'])->where('slug', '.*');
Route::get('/programs', [ProgramController::class, 'index']);
Route::get('/programs/{id}', [ProgramController::class, 'show']);
Route::get('/gallery-albums', [GalleryAlbumController::class, 'index']);
Route::get('/gallery-albums/{id}', [GalleryAlbumController::class, 'show']);
Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::get('/blog-posts', [BlogPostController::class, 'index']);
Route::get('/blog-posts/{identifier}', [BlogPostController::class, 'show']);
Route::get('/testimonials', [TestimonialController::class, 'index']);
Route::post('/testimonials', [TestimonialController::class, 'store']);
Route::post('/inquiries', [InquiryController::class, 'store']);
Route::get('/settings', [SettingController::class, 'index']);

// Protected (Admin)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);

    // Dashboard Stats (TODO)

    // Page Management
    Route::apiResource('admin/pages', PageController::class);
    Route::apiResource('admin/sections', SectionController::class);

    // Module Management
    Route::apiResource('admin/programs', ProgramController::class);
    Route::apiResource('admin/gallery-albums', GalleryAlbumController::class);
    // Route::apiResource('admin/gallery-images', GalleryImageController::class); // Nested in Album usually, or separate
    Route::apiResource('admin/events', EventController::class);
    Route::apiResource('admin/blog-posts', BlogPostController::class);
    Route::apiResource('admin/testimonials', TestimonialController::class)->except(['store']);
    Route::apiResource('admin/inquiries', InquiryController::class)->except(['store']);
    Route::apiResource('admin/settings', SettingController::class)->only(['index', 'store']); // Modified this line
    Route::post('/upload', [UploadController::class, 'store']); // Added this line
});
