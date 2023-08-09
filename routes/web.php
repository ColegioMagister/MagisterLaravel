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



    
    Route::get('/Sections', [SectionController::class, 'index'])->name('sections.principalIndex');
    Route::get('/Sections/periodo/{school_period}', [SectionController::class, 'innerShow'])->name('sections.index');
    Route::get('/Sections/{section}', [SectionController::class, 'show'])->name('sections.show');
    Route::get('/Sections/editAjax/{section}', [SectionController::class, 'getAjaxUpdate'])->name('sections.getUpdateAjax');
    Route::get('/Section/editStudentAjax/{section}/{student}', [SectionController::class, 'getAjaxStudentUpdate'])->name('sections.getStudentUpdateAjax');
    Route::get('/Section/editSubjectAjax/{section}/{subject}', [SectionController::class, 'getAjaxSubjectUpdate'])->name('sections.getSubjectUpdateAjax');
    Route::get('/Section/Horarios/{section}', [SectionController::class, 'scheduleIndex'])->name('sections.schedules.index');
    Route::post('/Section/Registrar/{school_period}', [SectionController::class, 'store'])->name('sections.store');
    Route::patch('/Section/Editar/{section}', [SectionController::class, 'update'])->name('sections.update');
    Route::patch('/Section/estudiante/actualizar/{section}/{student}', [SectionController::class, 'updateStudent'])->name('sections.updateStudent');
    Route::patch('/Section/materia/actualizar/{section}/{subject}', [SectionController::class, 'updateSubject'])->name('sections.updateSubject');
    Route::post('/Section/{section}/registrar-materia', [SectionController::class, 'registerSubject'])->name('sections.registerSubject');
    Route::post('/Section/{section}/registrar-estudiante', [SectionController::class, 'registerStudent'])->name('sections.registerStudent');

    Route::post('/Section/{section}/registrar-horarios', [SectionController::class, 'storeSchedules'])->name('sections.storeSchedules');

    Route::delete('/Section/Eliminar/{section}', [SectionController::class, 'destroy'])->name('sections.destroy');
    Route::delete('/Section/materia/Eliminar/{section}/{subject}', [SectionController::class, 'subjectDelete'])->name('sections.deleteSubject');
    Route::delete('/Section/estudiante/Eliminar/{section}/{student}', [SectionController::class, 'studentDetached'])->name('sections.studentDetached');





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