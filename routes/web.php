<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegistrationsController;
use App\Http\Controllers\RegistrateController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminActivityController;
use App\Http\Controllers\Admin\AdminQuestionController;
use App\Http\Controllers\Admin\AdminRegistrationsController;
use App\Http\Controllers\Admin\AdminAnswerController;
use App\Http\Controllers\Admin\AdminAdminController;
use App\Http\Controllers\Admin\AdminImportController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminExportController;
use App\Http\Controllers\Admin\AdminBulkDeleteController;
use App\Models\Activities;
use App\Models\Questions;
use App\Models\Registrations;
use App\Models\Answers;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public (If logged in)
Route::resource('/activiteiten', ActivitiesController::class)
    ->name('index', 'activities.index')
    ->middleware(['auth', 'verified']);

Route::resource('/inschrijven', RegistrateController::class)
    ->only(['index', 'store'])
    ->name('index', 'registrate.index')
    ->name('store', 'registrate.store')
    ->middleware(['auth', 'verified']);

Route::resource('/vragen', QuestionController::class)
    ->only(['index', 'store'])
    ->name('index', 'questions.index')
    ->name('store', 'questions.store')
    ->middleware(['auth', 'verified']);

Route::resource('/inschrijving', RegistrationsController::class)
    ->only(['index', 'destroy'])
    ->name('index', 'registration.index')
    ->name('destroy', 'registration.destroy')
    ->middleware(['auth', 'verified']);

Route::get('/activiteit/{id}', [ActivitiesController::class, 'show'])
    ->name('activities.show');

// Dashboard
Route::prefix('dashboard')->group(function () {
    Route::get('/', function () {
        $accounts = User::count();
        $activities = Activities::count();
        $registrations = Registrations::count();
        $questions = Questions::count();
        $answers = Answers::count();
        return view('dashboard/dashboard', ['accounts' => $accounts, 'activities' => $activities, 'registrations' => $registrations, 'questions' => $questions, 'answers' => $answers]);
    })->name('dashboard')->middleware(['auth', 'verified', 'can:view dashboard']);
    Route::resource('/accounts', AdminUserController::class)
        ->only(['index', 'edit', 'update', 'destroy', 'create', 'store'])
        ->name("index", 'dashboard.accounts.index')
        ->name("edit", 'dashboard.accounts.edit')
        ->name("update", 'dashboard.accounts.update')
        ->name("destroy", 'dashboard.accounts.destroy')
        ->name("create", 'dashboard.accounts.create')
        ->name("store", 'dashboard.accounts.store')
        ->middleware(['auth', 'verified', 'can:view dashboard']);
    Route::resource('/accounts/import', AdminImportController::class)
        ->only(['index', 'store'])
        ->name("index", 'dashboard.accounts.import')
        ->name("store", 'dashboard.accounts.import.store')
        ->middleware(['auth', 'verified', 'can:view dashboard']);
    Route::resource('/admin', AdminAdminController::class)
        ->only(['destroy', 'store'])
        ->name("store", 'dashboard.admin.store')
        ->name("destroy", 'dashboard.admin.destroy')
        ->middleware(['auth', 'verified', 'can:view dashboard']);
    Route::resource('/activiteiten', AdminActivityController::class)
        ->only(['index', 'destroy', 'create', 'store', 'edit', 'update'])
        ->name("index", 'dashboard.activities.index')
        ->name("destroy", 'dashboard.activities.destroy')
        ->name("create", 'dashboard.activities.create')
        ->name("edit", 'dashboard.activities.edit')
        ->name("update", 'dashboard.activities.update')
        ->name("store", 'dashboard.activities.store')
        ->middleware(['auth', 'verified', 'can:view dashboard']);
    Route::resource('/inschrijvingen', AdminQuestionController::class)
        ->only(['index', 'destroy'])
        ->name("index", 'dashboard.registrations.index')
        ->name("destroy", 'dashboard.registrations.destroy')
        ->middleware(['auth', 'verified', 'can:view dashboard']);
    Route::resource('/vragen', AdminQuestionController::class)
        ->only(['index', 'destroy', 'create', 'store'])
        ->name("index", 'dashboard.questions.index')
        ->name("create", 'dashboard.questions.create')
        ->name("store", 'dashboard.questions.store')
        ->name("destroy", 'dashboard.questions.destroy')
        ->middleware(['auth', 'verified', 'can:view dashboard']);
    Route::resource('/vragen/antwoorden', AdminAnswerController::class)
        ->only(['index', 'destroy'])
        ->name("index", 'dashboard.answers.index')
        ->name("destroy", 'dashboard.answers.destroy')
        ->middleware(['auth', 'verified', 'can:view dashboard']);
    Route::resource('/inschrijvingen', AdminRegistrationsController::class)
        ->only(['index', 'destroy', 'create', 'store'])
        ->name("index", 'dashboard.registrations.index')
        ->name("store", 'dashboard.registrations.store')
        ->name("destroy", 'dashboard.registrations.destroy')
        ->middleware(['auth', 'verified', 'can:view dashboard']);
    Route::get('/inschrijven/{user_id}', [AdminRegistrationsController::class, "create"])
        ->name('dashboard.registrations.create')
        ->middleware(['auth', 'verified', 'can:view dashboard']);
    Route::resource('/instellingen', AdminSettingsController::class)
        ->only(['index', 'update'])
        ->name("index", 'dashboard.settings.index')
        ->name("update", 'dashboard.settings.update')
        ->middleware(['auth', 'verified', 'can:view dashboard']);
    Route::resource('/exporteren', AdminExportController::class)
        ->only(['index', 'store'])
        ->name("index", 'dashboard.export.index')
        ->name("store", 'dashboard.export.store')
        ->middleware(['auth', 'verified', 'can:view dashboard']);
    Route::resource('/resetten', AdminBulkDeleteController::class)
        ->only(['index', 'store'])
        ->name("index", 'dashboard.bulk-delete.index')
        ->name("store", 'dashboard.bulk-delete.store')
        ->middleware(['auth', 'verified', 'can:view dashboard']);
});

// Auth
Route::middleware('auth')->group(function () {
    Route::get('/profiel', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profiel', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profiel', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// A test route for setting up some things, disable this by delfault
Route::resource('/setup', RolesController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
