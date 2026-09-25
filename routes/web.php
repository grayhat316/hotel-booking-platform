<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Auth routes
Route::get('/login', [\App\Http\Controllers\Auth\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->middleware('auth');

// Public routes
Route::get('/', [\App\Http\Controllers\PublicController::class, 'home']);
Route::get('/rooms', [\App\Http\Controllers\PublicController::class, 'rooms']);
Route::get('/rooms/{room}', [\App\Http\Controllers\PublicController::class, 'roomShow']);
Route::get('/dining', [\App\Http\Controllers\PublicController::class, 'dining']);
Route::get('/conference', [\App\Http\Controllers\PublicController::class, 'conference']);
Route::get('/events', [\App\Http\Controllers\PublicController::class, 'events']);
Route::get('/gallery', [\App\Http\Controllers\PublicController::class, 'gallery']);
Route::get('/contact', [\App\Http\Controllers\PublicController::class, 'contact']);
Route::post('/contact', [\App\Http\Controllers\PublicController::class, 'submitContact']);

// Booking routes (public)
Route::get('/booking/{room}', [\App\Http\Controllers\BookingController::class, 'create']);
Route::post('/booking/{room}', [\App\Http\Controllers\BookingController::class, 'store']);
Route::get('/booking/confirmation/{booking}', [\App\Http\Controllers\BookingController::class, 'confirmation'])->name('booking.confirmation');
Route::get('/my-bookings', [\App\Http\Controllers\BookingController::class, 'index']);

// Admin routes (authenticated)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('rooms', \App\Http\Controllers\Admin\RoomController::class);
    Route::resource('foods', \App\Http\Controllers\Admin\FoodController::class);
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('gallery', \App\Http\Controllers\Admin\GalleryController::class);
    
    Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class)->except(['create', 'store']);
});

// Serve uploads through Laravel route (PHP serve doesn't serve public/ static files on Windows)
Route::get('/uploads/{path}', function ($path) {
    $file = public_path('uploads/' . $path);
    if (!file_exists($file)) {
        abort(404);
    }
    $content = file_get_contents($file);
    $mimeType = mime_content_type($file);
    return Response::make($content, 200, ['Content-Type' => $mimeType]);
})->where('path', '.*');

// Redirect /admin to dashboard
Route::redirect('/admin', '/admin/dashboard');
