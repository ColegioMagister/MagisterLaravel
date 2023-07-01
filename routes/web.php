<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\{
    UserController,
    StudentController,
    AssessmentController,
    QuotaController,
    ScheduleController,
    SectionController,
    SubjectsController,
    YearController
};

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/Home', [HomeController::class, 'index'])->name('home');
Route::get('/Profesor', [UserController::class, 'index'])->name('teacher.index');

Route::resource("/Students", StudentController::class);
Route::get('/Students', [StudentController::class, 'index'])->name('students.index');

Route::get('/Assessment', [AssessmentController::class, 'index'])->name('assessment.index');
Route::get('/Quota', [QuotaController::class, 'index'])->name('quota.index');
Route::get('/Schedule', [ScheduleController::class, 'index'])->name('schedule.index');
Route::get('/Sections', [SectionController::class, 'index'])->name('sections.index');
Route::get('/Subject', [SubjectsController::class, 'index'])->name('subject.index');
Route::get('/SchoolYear', [YearController::class, 'index'])->name('schoolYear.index');