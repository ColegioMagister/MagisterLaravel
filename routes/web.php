<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Admin\{
    UserController,
    StudentController,
    GeneralDataController,
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
Route::group(['middleware'=>['auth', 'check.role:Admin']], function () {

    Route::get('/Home', [HomeController::class, 'index'])->name('home');

    Route::get('/Data', [GeneralDataController::class, 'index'])->name('data.index');

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
    Route::get('/sections/editAjax/{section}', [SectionController::class, 'getAjaxUpdate'])->name('sections.getUpdateAjax');
    Route::post('/Section/Registrar', [SectionController::class, 'store'])->name('sections.store');
    Route::delete('/Section/Eliminar/{section}', [SectionController::class, 'destroy'])->name('sections.destroy');
    Route::patch('/Section/Editar/{section}', [SectionController::class, 'update'])->name('sections.update');

    Route::resource('/Subject',SubjectsController::class);
    Route::get('/Subject', [SubjectsController::class, 'index'])->name('subject.index');
    Route::post('/Subject', [SubjectsController::class, 'store'])->name('subjet');
    Route::get('/Subject/{subject}/editar', [SubjectsController::class, 'edit'])->name('subjects.ajax.edit');


    Route::get('/SchoolYear', [YearController::class, 'index'])->name('schoolYear.index');

    Route::get('/descarga-libreta/{student}', [StudentController::class, 'ReporteLibreta'])->name('reportes.libreta');
    Route::get('/descarga-alumnos', [StudentController::class, 'ReporteAlumnos'])->name('reportes.alumnos');



});


Route::group(['middleware' => ['auth', 'check.role:Profesor']], function () {

    Route::get('/HomeTeacher', [EmployeeController::class, 'index'])->name('homeTeacher');

});