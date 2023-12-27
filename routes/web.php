<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\Teacher\{TeacherSectionController};
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
    EmployeesController,
    ProfileController
};


Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
Route::get('/NewPassword', [ProfileController::class, 'NewPassword'])->name('user.editprofile')->middleware('auth');
Route::post('/change/password', [ProfileController::class, 'changePassword'])->name('changePassword');

Route::group(['middleware' => ['auth', 'check.role:Admin']], function () {

    Route::get('/Home', [GeneralDataController::class, 'index'])->name('data.index');

    Route::controller(EmployeesController::class)->group(function () {
        Route::get('/Employees', 'index')->name('user.index');
        Route::get('/user/{user}', 'show')->name('user.show');
        Route::post('/check-user', 'checkUsuario')->name('checkUsuario');
        Route::post('/Employees/registrar', 'store')->name('user.store');
        Route::delete('/Employees/{user}/delete', 'destroy')->name('user.destroy');
    });

    Route::get('/Students', [StudentController::class, 'index'])->name('students.index');
    Route::post('/check-student', [StudentController::class, 'checkStudent'])->name('checkStudent');
    Route::post('/Students/registrar', [StudentController::class, 'store'])->name('students.store');
    Route::get('/Students/{student}/editarAjax', [StudentController::class, 'edit'])->name('students.ajax.edit');
    Route::patch('/Students/{student}/editar', [StudentController::class, 'update'])->name('students.edit');
    Route::get('/Student/{student}', [StudentController::class, 'show'])->name('students.show');
    Route::delete('/Student/{student}/delete', [StudentController::class, 'destroy'])->name('students.destroy');


    Route::get('/Profesor', [UserController::class, 'index'])->name('teacher.index');
    Route::post('/check-teacher', [UserController::class, 'checkTeacher'])->name('checkTeacher');
    Route::post('/Profesor/registrar', [UserController::class, 'store'])->name('teacher.store');
    Route::get('/Profesor/{employee}', [UserController::class, 'show'])->name('teacher.show');
    Route::get('/Profesor/{employee}/editarAjax', [UserController::class, 'edit'])->name('teacher.ajax.edit');
    Route::patch('/Profesor/{employee}/editar', [UserController::class, 'update'])->name('teacher.edit');
    Route::delete('/Profesor/{employee}/destroy', [UserController::class, 'destroy'])->name('teacher.destroy');



    Route::get('/Profesor/Materias/{employee}', [UserController::class, 'showSubject'])->name('teacher.teacherSubject');
    Route::delete('/Profesor/Materias/Eliminar/{employee}/{subject}', [UserController::class, 'destroySubject'])->name('teacher.deleteSubject');
    Route::post('/Profesor/AsignarMateria/{employee}', [UserController::class, 'AsignarSubject'])->name('teacher.AddSubjec');
    Route::get('/Profesor/AsignarMateriaAjax/{employee}', [UserController::class, 'AsignarSubjectAjax'])->name('teacher.AddSubjectAjax');

    Route::get('/Sections', [SectionController::class, 'index'])->name('sections.principalIndex');
    Route::get('/Sections/periodo/{school_period}', [SectionController::class, 'innerShow'])->name('sections.index');
    Route::get('/Sections/{section}', [SectionController::class, 'show'])->name('sections.show');
    Route::get('/Sections/editAjax/{section}', [SectionController::class, 'getAjaxUpdate'])->name('sections.getUpdateAjax');
    Route::get('/Section/editStudentAjax/{section}/{student}', [SectionController::class, 'getAjaxStudentUpdate'])->name('sections.getStudentUpdateAjax');
    Route::get('/Section/editSubjectAjax/{section}/{subject}', [SectionController::class, 'getAjaxSubjectUpdate'])->name('sections.getSubjectUpdateAjax');
    Route::get('/Section/Horarios/{section}', [SectionController::class, 'scheduleIndex'])->name('sections.schedules.index');
    Route::get('/Section/Evaluaciones/{section}/{subject}', [SectionController::class, 'assessmentIndex'])->name('sections.assessments.index');
    Route::post('/Section/Registrar/{school_period}', [SectionController::class, 'store'])->name('sections.store');
    Route::patch('/Section/Editar/{section}', [SectionController::class, 'update'])->name('sections.update');
    Route::patch('/Section/estudiante/actualizar/{section}/{student}', [SectionController::class, 'updateStudent'])->name('sections.updateStudent');
    Route::patch('/Section/materia/actualizar/{section}/{subject}', [SectionController::class, 'updateSubject'])->name('sections.updateSubject');
    Route::post('/Section/{section}/registrar-materia', [SectionController::class, 'registerSubject'])->name('sections.registerSubject');
    Route::post('/Section/{section}/registrar-estudiante', [SectionController::class, 'registerStudent'])->name('sections.registerStudent');
    Route::post('/Section/{section}/registrar-evaluación/{subject}', [SectionController::class, 'registerAssessment'])->name('assessmentSection.store');
    Route::post('/Section/{section}/registrar-horarios', [SectionController::class, 'storeSchedules'])->name('sections.storeSchedules');
    Route::post('/Section/load-date/{section}/{subject}', [SectionController::class, 'ajaxLoadDate'])->name('assessmentSection.LoadDate');
    Route::delete('/Section/Eliminar/{section}', [SectionController::class, 'destroy'])->name('sections.destroy');
    Route::delete('/Section/materia/Eliminar/{section}/{subject}', [SectionController::class, 'subjectDelete'])->name('sections.deleteSubject');
    Route::delete('/Section/estudiante/Eliminar/{section}/{student}', [SectionController::class, 'studentDetached'])->name('sections.studentDetached');
    Route::delete('/Section/evaluación/Eliminar/{assessment}', [SectionController::class, 'assessmentDestroy'])->name('sections.assessment.destroy');




    Route::get('/Assessment', [AssessmentController::class, 'index'])->name('assessment.index');
    Route::get('/Assessment/get-edit-ajax-data/{assessment}', [AssessmentController::class, 'getEditAjaxData'])->name('assessment.getEditAjaxData');
    Route::post('/Assessment/registrar', [AssessmentController::class, 'store'])->name('assessment.store');
    Route::patch('/Assessment/actualizar/{assessment}', [AssessmentController::class, 'update'])->name('assessment.update');
    Route::delete('/Assessment/eliminar/{assessment}', [AssessmentController::class, 'destroy'])->name('assessment.destroy');




    Route::get('/Subject', [SubjectsController::class, 'index'])->name('subject.index');
    Route::post('/check-subject', [SubjectsController::class, 'checkSubject'])->name('checkSubject');
    Route::post('/Subject/registrar', [SubjectsController::class, 'store'])->name('subject.store');
    Route::patch('/Subject/{subject}/editar', [SubjectsController::class, 'update'])->name('subjects.edit');
    Route::get('/Subject/{subject}/editarAjax', [SubjectsController::class, 'edit'])->name('subjects.ajax.edit');
    Route::delete('/Subject/{subject}/eliminar', [SubjectsController::class, 'destroy'])->name('subject.destroy');



    Route::get('/SchoolYear', [YearController::class, 'index'])->name('schoolYear.index');
    Route::post('/SchoolYear', [YearController::class, 'store'])->name('schoolYear.store');
    Route::get('/SchoolYear/{school_period}', [YearController::class, 'show'])->name('schoolYear.show');
    Route::get('/SchoolYearSectionStudent/{section}', [YearController::class, 'showStudent'])->name('schoolYear.studentShow');
    Route::get('/SchoolYear/{school_period}/editar', [YearController::class, 'edit'])->name('school_periods.ajax.edit');
    Route::patch('/SchoolYear/{school_period}/editar', [YearController::class, 'update'])->name('school_periods.edit');
    Route::delete('/SchoolYear/{school_period}/eliminar', [YearController::class, 'destroy'])->name('school_periods.delete');




    Route::get('/descarga-libreta/{student}', [StudentController::class, 'ReporteLibreta'])->name('reportes.libreta');
    Route::get('/descarga-alumnos', [StudentController::class, 'ReporteAlumnos'])->name('reportes.alumnos');



});


Route::group(['middleware' => ['auth', 'check.role:Profesor']], function () {

    Route::get('/HomeTeacher', [GeneralDataController::class, 'indexTeacher'])->name('homeTeacher');
    Route::get('/Teacher', [TeacherSectionController::class, 'index'])->name('teacherView.index');
    Route::get('/TeacherPeriodo/{school_period}', [TeacherSectionController::class, 'show'])->name('teacherView.section');
    Route::get('/TeacherSeccion/{section}', [TeacherSectionController::class, 'showDetails'])->name('teacherView.subject');
    Route::get('/Teacher{section}/AssessmentAttendace/{subject}', [TeacherSectionController::class, 'index2'])->name('teacherView.assessmentAttendaces');
    Route::get('/Teacher/{section}/Assessment/{subject}', [TeacherSectionController::class, 'showAssess'])->name('teacherView.assessment');
    Route::post('/Teacher/RegisterNota', [TeacherSectionController::class, 'registerNota'])->name('teacherView.registerNota');

    Route::get('/Teacher/editStudentAjaxNota/{student}/{assessment}', [TeacherSectionController::class, 'getAjaxStudentUpdateNota'])->name('teacherView.AjaxUpdateStudentNota');
    Route::patch('/Teacher/estudianteNota/actualizar/{student}/{assessment}', [TeacherSectionController::class, 'updateStudentNota'])->name('teacherView.updateStudentNota');

    Route::get('/Teacher/{section}/Attendace/{subject}/Fecha/{schedule}', [TeacherSectionController::class, 'showAttendance'])->name('teacherView.attedance');
    Route::post('/Teacher/RegisterAsistencia', [TeacherSectionController::class, 'registerAttendance'])->name('teacherView.registerAttendance');


});