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
    YearController,
    EmployeesController
};


Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::get('/Home', [HomeController::class, 'index'])->name('home');

Route::resource('/Employees',EmployeesController::class);
Route::get('/Employees', [EmployeesController::class, 'index'])->name('user.index');

Route::resource("/Students", StudentController::class);
Route::get('/Students', [StudentController::class, 'index'])->name('students.index');
Route::get('/Students/{student}/editar', [StudentController::class, 'edit'])->name('students.ajax.edit');

Route::resource("/Profesor", UserController::class);
Route::get('/Profesor', [UserController::class, 'index'])->name('teacher.index');

Route::get('/Assessment', [AssessmentController::class, 'index'])->name('assessment.index');
Route::get('/Quota', [QuotaController::class, 'index'])->name('quota.index');
Route::get('/Schedule', [ScheduleController::class, 'index'])->name('schedule.index');
Route::get('/Sections', [SectionController::class, 'index'])->name('sections.index');
Route::get('/Subject', [SubjectsController::class, 'index'])->name('subject.index');
Route::get('/SchoolYear', [YearController::class, 'index'])->name('schoolYear.index');

Route::get('/descarga-libreta/{student}', [App\Http\Controllers\Admin\StudentController::class, 'ReporteLibreta'])->name('reportes.libreta');