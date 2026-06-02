<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactEnquiryController;
use Illuminate\Support\Facades\Route;

// ── Auth ──────────────────────────────────────────────────────────────────────
Route::post('v1/login', [AuthController::class, 'login']);

// ── Public read routes ────────────────────────────────────────────────────────
Route::prefix('v1')->group(function () {
    Route::get('courses',            [CourseController::class,      'index']);
    Route::get('courses/{id}',       [CourseController::class,      'show']);
    Route::get('events',             [EventController::class,       'index']);
    Route::get('events/{id}',        [EventController::class,       'show']);
    Route::get('gallery',            [GalleryController::class,     'index']);
    Route::get('gallery/{id}',       [GalleryController::class,     'show']);
    Route::get('testimonials',       [TestimonialController::class, 'index']);
    Route::get('testimonials/{id}',  [TestimonialController::class, 'show']);
    Route::get('team-members',       [TeamMemberController::class,  'index']);
    Route::get('team-members/{id}',  [TeamMemberController::class,  'show']);
    Route::get('articles',           [ArticleController::class,     'index']);
    Route::get('articles/{id}',      [ArticleController::class,     'show']);
    Route::get('site-settings',      [SiteSettingController::class, 'index']);
    Route::post('contact-us',        [ContactEnquiryController::class, 'store']);
});

// ── Protected admin routes ────────────────────────────────────────────────────
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::post('logout',           [AuthController::class, 'logout']);
    Route::get('user',              [AuthController::class, 'me']);

    Route::apiResource('courses',       CourseController::class)->only(['store','update','destroy']);
    Route::apiResource('events',        EventController::class)->only(['store','update','destroy']);
    Route::apiResource('gallery',       GalleryController::class)->only(['store','update','destroy']);
    Route::apiResource('testimonials',  TestimonialController::class)->only(['store','update','destroy']);
    Route::apiResource('team-members',  TeamMemberController::class)->only(['store','update','destroy']);
    Route::apiResource('articles',      ArticleController::class)->only(['store','update','destroy']);
    Route::put('site-settings',         [SiteSettingController::class, 'update']);

    Route::get('contact-enquiries',                    [ContactEnquiryController::class, 'index']);
    Route::patch('contact-enquiries/{id}/read',        [ContactEnquiryController::class, 'markRead']);
    Route::delete('contact-enquiries/{id}',            [ContactEnquiryController::class, 'destroy']);
});
