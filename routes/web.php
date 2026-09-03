<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;

// Controller Frontend
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProjectController as FrontendProjectController;
use App\Http\Controllers\Frontend\ContactController;

// Controller Auth & Admin
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Frontend\CertificateController as FrontendCertificateController;
use App\Http\Controllers\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Admin\SocialLinkController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects', [FrontendProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [FrontendProjectController::class, 'show'])->name('projects.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/certificates', [FrontendCertificateController::class, 'index'])->name('certificates.index');

Route::get('/resume', function () {
    $profile = Profile::first();
    if ($profile && $profile->cv_file && Storage::disk('public')->exists($profile->cv_file)) {
        return Storage::disk('public')->download($profile->cv_file, 'CV-' . str_replace(' ', '-', $profile->name) . '.pdf');
    }
    return back()->with('error', 'Berkas CV belum diunggah.');
})->name('resume.download');

// Dynamic Sitemap XML
Route::get('/sitemap.xml', function () {
    $projects = \App\Models\Project::published()->get();

    $content = view('frontend.sitemap', compact('projects'));
    return response($content, 200)->header('Content-Type', 'text/xml');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin CMS Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profile CMS
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Messages CMS
    Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{id}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

    // Projects CMS (Menggunakan AdminProjectController)
    Route::resource('projects', AdminProjectController::class);

    // Quick Add Kategori & Teknologi
    Route::post('/project-categories/quick', [AdminProjectController::class, 'quickStoreCategory'])->name('project-categories.quick');
    Route::post('/technologies/quick', [AdminProjectController::class, 'quickStoreTechnology'])->name('technologies.quick');
    // Hapus Kategori & Teknologi
    Route::delete('/project-categories/{id}', [AdminProjectController::class, 'destroyCategory'])->name('project-categories.destroy');
    Route::delete('/technologies/{id}', [AdminProjectController::class, 'destroyTechnology'])->name('technologies.destroy');

    // Skills CMS
    Route::resource('skills', SkillController::class);

    // Experience CMS
    Route::resource('experiences', ExperienceController::class);

    // Education CMS
    Route::resource('educations', EducationController::class);

    // Certificates CMS
    Route::resource('certificates', AdminCertificateController::class);

    // Social Links CMS
    Route::resource('social-links', SocialLinkController::class);
});
