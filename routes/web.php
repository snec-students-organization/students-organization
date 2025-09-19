<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\CommitteeMemberController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\GalleryEventController;
use App\Http\Controllers\Admin\EventImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UpcomingEventController;
use App\Http\Controllers\InstitutionAuthController;
use App\Http\Controllers\InstitutionDashboardController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\InstitutionOrganizationController;
use App\Http\Controllers\Admin\AdminInstitutionController;
use App\Http\Controllers\AboutController;

use App\Http\Controllers\InstitutionDataController;
use App\Http\Controllers\Admin\FeatureFlagController;
use App\Http\Controllers\Admin\DataCollectionController;
use App\Http\Controllers\Admin\StudentExportController;

use App\Http\Controllers\MembershipCardController;

use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\Admin\MonthlyReportAdminController;
// =============================
// Public Routes
// =============================

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');

Route::get('/organizations', [OrganizationController::class, 'index'])->name('organizations.index');

Route::get('/calendar', [EventController::class, 'index'])->name('calendar');
Route::get('/events/fetch', [EventController::class, 'fetch'])->name('events.fetch');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{event}', [GalleryController::class, 'show'])->name('gallery.show');

Route::get('/committees', [CommitteeController::class, 'index'])->name('committees.index');

// Guest-accessible notifications (also available for authenticated users)
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

// =============================
// Authentication Routes (users)
// =============================

require __DIR__.'/auth.php';

// =============================
// Institution Login Routes
// =============================

Route::get('/institution/login', [InstitutionAuthController::class, 'showLoginForm'])->name('institution.login');
Route::post('/institution/login', [InstitutionAuthController::class, 'login'])->name('institution.login.submit');
Route::post('/institution/logout', [InstitutionAuthController::class, 'logout'])->name('institution.logout');

// =============================
// Authenticated User Routes
// =============================

Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // (Duplicated notification routes not required since public already permits)
    // Payments (User)
    Route::get('/payments/user', [PaymentController::class, 'createUserPayment'])->name('payments.user.create');
    Route::post('/payments/user', [PaymentController::class, 'storeUserPayment'])->name('payments.user.store');
});

// =============================
// Authenticated Institution Routes
// =============================

Route::middleware(['auth:institution'])->group(function () {
    Route::get('/institution/dashboard', [InstitutionDashboardController::class, 'index'])->name('institution.dashboard');

    // Institution student management
    Route::get('/students', [InstitutionController::class, 'studentsIndex'])->name('institution.students.index');
    Route::get('/students/create', [InstitutionController::class, 'studentsCreate'])->name('institution.students.create');
    Route::post('/students', [InstitutionController::class, 'studentsStore'])->name('institution.students.store');

    // Payments (Institution)
    Route::get('/payments/institution', [PaymentController::class, 'createInstitutionPayment'])->name('payments.institution.create');
    Route::post('/payments/institution', [PaymentController::class, 'storeInstitutionPayment'])->name('payments.institution.store');
});

// =============================
// Admin Routes
// =============================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard & Users
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');

        // Organizations (CRUD except index, which is public)
        Route::resource('organizations', OrganizationController::class)->except(['index']);
        // Verification route
    Route::put('organizations/{organization}/verify', [OrganizationController::class, 'verify'])
        ->name('organizations.verify');

        // Events (admin full control)
        Route::get('/events', [EventController::class, 'adminIndex'])->name('events.index');
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

        // Committees (Admin)
        Route::resource('committees', CommitteeMemberController::class);

        // Gallery Events
        Route::resource('gallery-events', GalleryEventController::class);
        // Mark/Unmark gallery event
        Route::post('gallery-events/{id}/mark', [GalleryEventController::class, 'toggleMark'])->name('gallery-events.mark');
        // Gallery Event Images
        Route::resource('gallery-events.images', EventImageController::class);
        // Mark/Unmark gallery event image
        Route::post('gallery-events/{event}/images/{image}/mark', [EventImageController::class, 'toggleMark'])->name('gallery-events.images.mark');
        
       


        // Upcoming Events
        Route::resource('upcoming-events', UpcomingEventController::class);

        // Notifications (Admin)
        Route::resource('notifications', AdminNotificationController::class);

        // Admin Student verification
        Route::get('students', [AdminController::class, 'studentsIndex'])->name('students.index');
      


        // Admin Payments view
        Route::get('/payments', [PaymentController::class, 'adminIndex'])->name('payments.index');
        //payment settings
        Route::get('/payment-settings', [PaymentSettingController::class, 'edit'])->name('payment-settings.edit');
        Route::post('/payment-settings', [PaymentSettingController::class, 'update'])->name('payment-settings.update');

   

    });
     
Route::middleware(['auth:institution'])
    ->prefix('institution')
    ->name('institution.')
    ->group(function () {
        // Show the single add/edit organization form for institution
        Route::get('/organization', [InstitutionOrganizationController::class, 'showOrganizationFormForInstitution'])->name('organization.form');

        // Save or update submitted organization details
        Route::post('/organization', [InstitutionOrganizationController::class, 'saveOrganizationForInstitution'])->name('organization.save');
    });


    Route::middleware('auth:institution')->prefix('institution')->name('institution.')->group(function () {
    Route::get('/details/add', [InstitutionDashboardController::class, 'addDetails'])->name('details.add');
    Route::post('/details/store', [InstitutionDashboardController::class, 'storeDetails'])->name('details.store');
    Route::get('/details/edit', [InstitutionDashboardController::class, 'editDetails'])->name('details.edit');
    Route::put('/details/update', [InstitutionDashboardController::class, 'updateDetails'])->name('details.update');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/institutions', [AdminInstitutionController::class, 'index'])->name('institutions.index');
    Route::get('/institutions/{institution}', [AdminInstitutionController::class, 'show'])->name('institutions.show');

   
});
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('feature-flags', [FeatureFlagController::class, 'index'])->name('admin.feature_flags.index');
    Route::patch('feature-flags/{flag}', [FeatureFlagController::class, 'update'])->name('admin.feature_flags.update');
});




Route::middleware('auth:institution')->group(function () {
    Route::get('/institution-data', [InstitutionDataController::class, 'create'])->name('institution-data.create');
    Route::post('/institution-data', [InstitutionDataController::class, 'store'])->name('institution-data.store');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/data-collection/institutions', [DataCollectionController::class, 'institutionDataIndex'])->name('data.collection.institutions');
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/submit-data', [UserController::class, 'submitDataForm'])->name('user.submit.form');
    Route::post('/user/submit-data', [UserController::class, 'submitData'])->name('user.submit.store');
});
Route::middleware('auth')->group(function () {
    // Edit student details
    Route::get('/user/details/edit', [UserController::class, 'editDetails'])->name('user.student.edit');

    // Update student details
    Route::put('/user/details/update', [UserController::class, 'updateDetails'])->name('user.student.update');
});

// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/user/details/edit', [UserController::class, 'editDetails'])
        ->name('user.student.edit');

    Route::put('/user/details/update', [UserController::class, 'updateDetails'])
        ->name('user.student.update');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::patch('students/{student}/status', [App\Http\Controllers\AdminController::class, 'updateStudentStatus'])
        ->name('student.updateStatus');

        
});

Route::get('admin/students-by-institution', [AdminController::class, 'studentsByInstitution'])
    ->name('admin.students.byInstitution')
    ->middleware(['auth', 'admin']);

Route::get('/admin/institutions/{id}/export-students', [App\Http\Controllers\Admin\StudentController::class, 'exportInstitutionStudents'])
    ->name('admin.institutions.exportStudents');

 

    Route::prefix('admin')->group(function () {
    Route::get('/students/export/{institutionId}', [StudentExportController::class, 'exportInstitutionStudents'])
        ->name('admin.students.exportByInstitution');

    Route::get('/students/export-all', [StudentExportController::class, 'exportAllStudents'])
        ->name('admin.students.exportAll');
});



Route::get('/membership-card/download', [MembershipCardController::class, 'download'])
     ->name('membership-card.download')
     ->middleware('auth:institution');

Route::get('/membership/download', [UserController::class, 'downloadMembership'])
    ->name('membership.download')
    ->middleware('auth');


    // routes/web.php

// Institution routes


Route::middleware('auth:institution')->prefix('institution')->name('institution.')->group(function () {
    // Upload form
    Route::get('/reports/upload', [MonthlyReportController::class, 'create'])->name('reports.upload');

    // Store report
    Route::post('/reports/store', [MonthlyReportController::class, 'store'])->name('reports.store');

    // List uploaded reports
    Route::get('/reports', [MonthlyReportController::class, 'index'])->name('reports.index');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/reports', [App\Http\Controllers\Admin\MonthlyReportAdminController::class, 'index'])->name('reports.index');
});
