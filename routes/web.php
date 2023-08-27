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
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\DiscussedController;
use App\Models\Activities;
use App\Models\Questions;
use App\Models\Registrations;
use App\Models\Answers;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

// Public (If logged in)
Route::resource('/activiteiten', ActivitiesController::class)
    ->name('index', 'activities.index')
    ->middleware(['auth', 'verified']);

Route::post('/discussed', [DiscussedController::class, "store"])
    ->name('discussed.store');

Route::get('/error', function ($arr) {
    view("error", ["error" => $arr]);
})->name('index', 'error');

Route::resource('/inschrijven', RegistrateController::class)
    ->only(['index', 'store'])
    ->name('index', 'registrate.index')
    ->name('store', 'registrate.store')
    ->middleware(['auth', 'verified']);

Route::prefix('vragen')->group(function () {
    Route::resource('/', QuestionController::class)
        ->name('index', 'questions.index')
        ->middleware(['auth', 'verified']);
    Route::post('/update', [AnswerController::class, "update"])
        ->name('answers.update');
})->middleware(['auth', 'verified']);

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
        ->only(['index', 'destroy', 'create', 'store', 'edit'])
        ->name("index", 'dashboard.activities.index')
        ->name("destroy", 'dashboard.activities.destroy')
        ->name("create", 'dashboard.activities.create')
        ->name("edit", 'dashboard.activities.edit')
        ->name("store", 'dashboard.activities.store')
        ->middleware(['auth', 'verified', 'can:view dashboard']);

    Route::post('/activiteiten/update', [AdminActivityController::class, "update"])
        ->name('dashboard.activities.update');

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
        ->only(['index'])
        ->name("index", 'dashboard.settings.index')
        ->middleware(['auth', 'verified', 'can:view dashboard']);

    Route::post('/instellingen/update', [AdminSettingsController::class, "update"])
        ->name('dashboard.settings.update')
        ->middleware(['auth', 'verified', 'can:view dashboard']);

    Route::get('/exporteren', function () {
        return view('dashboard/export');
    })->name('dashboard.export.index')->middleware(['auth', 'verified', 'can:view dashboard']);

    Route::get('/exporteren/export', [AdminExportController::class, 'export'])
        ->name('dashboard.export.export')
        ->middleware(['auth', 'verified', 'can:view dashboard']);

    Route::resource('/resetten', AdminBulkDeleteController::class)
        ->only(['index', 'store'])
        ->name("index", 'dashboard.bulk_delete.index')
        ->name("store", 'dashboard.bulk_delete.store')
        ->middleware(['auth', 'verified', 'can:view dashboard']);

    Route::post('/resetten/accounts', [AdminBulkDeleteController::class, 'accounts'])
        ->name('dashboard.bulk_delete.delete.accounts')
        ->middleware(['auth', 'verified', 'can:view dashboard']);

    Route::post('/resetten/activiteiten', [AdminBulkDeleteController::class, 'activities'])
        ->name('dashboard.bulk_delete.delete.activities')
        ->middleware(['auth', 'verified', 'can:view dashboard']);

    Route::post('/resetten/inschrijvingen', [AdminBulkDeleteController::class, 'signups'])
        ->name('dashboard.bulk_delete.delete.signups')
        ->middleware(['auth', 'verified', 'can:view dashboard']);

    Route::post('/resetten/vragen', [AdminBulkDeleteController::class, 'questions'])
        ->name('dashboard.bulk_delete.delete.questions')
        ->middleware(['auth', 'verified', 'can:view dashboard']);

    Route::post('/resetten/antwoorden', [AdminBulkDeleteController::class, 'answers'])
        ->name('dashboard.bulk_delete.delete.answers')
        ->middleware(['auth', 'verified', 'can:view dashboard']);
});

Route::any("/cheat", function () {
    $registrations = (object)array(
        // Ayla
        array(
            "user_id" => 1857,
            "activity_id" => 23,
        ),
        // Gino
        array(
            "user_id" => 3310,
            "activity_id" => 23,
        ),
        // Daan
        array(
            "user_id" => 3308,
            "activity_id" => 22,
        ),
        // Seppe
        array(
            "user_id" => 3191,
            "activity_id" => 22,
        ),
        // Mathijs
        array(
            "user_id" => 3188,
            "activity_id" => 22,
        ),
        // Melody
        array(
            "user_id" => 3207,
            "activity_id" => 22,
        ),
        // Jeff
        array(
            "user_id" => 3311,
            "activity_id" => 22,
        ),
        // Yana
        array(
            "user_id" => 3210,
            "activity_id" => 22,
        ),
        // Kasper
        array(
            "user_id" => 1627,
            "activity_id" => 17,
        ),
        // Lucas
        array(
            "user_id" => 1629,
            "activity_id" => 17,
        ),
        // Jan
        array(
            "user_id" => 1626,
            "activity_id" => 22,
        ),
        // Femke
        array(
            "user_id" => 3200,
            "activity_id" => 22,
        ),
        // Maite
        array(
            "user_id" => 1829,
            "activity_id" => 22,
        ),
        // Jens
        array(
            "user_id" => 1657,
            "activity_id" => 22,
        ),
        // Sander
        array(
            "user_id" => 3313,
            "activity_id" => 23,
        ),
        // Hannes
        array(
            "user_id" => 1832,
            "activity_id" => 23,
        ),
        // Jonas
        array(
            "user_id" => 1913,
            "activity_id" => 23,
        ),
    );

    foreach ($registrations as $user) {
        Registrations::create([
            'user_id' => $user["user_id"],
            'activity_id' => $user["activity_id"],
        ]);
        ActivitiesController::update($user["activity_id"]);
    }

    echo "Done :-)";
    return;
})
    ->middleware(['auth', 'verified', 'can:view dashboard']);

// Auth
Route::middleware('auth')->group(function () {
    Route::get('/profiel', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profiel', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profiel', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
