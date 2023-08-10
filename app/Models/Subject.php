<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
                Assessment,
                Schedule,
                Section,
                TeacherSections,
                Employee
            };

class Subject extends Model
{
    use HasFactory;
    protected $table='subjects';
    protected $guarded=[];

    public function teacherSubjects()
    {
        return $this->belongsToMany(Employee::class,'teacher_has_subjects', 'id_subject', 'id_teacher')
                                    ->withPivot('id')->withTimestamps();
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'id_subject', 'id');
    }

    public function subjectSection()
    {
        return $this->belongsToMany(Section::class,'section_has_subjects', 'id_subject', 'id_section')
                                    ->withPivot('id')->withTimestamps();
    }

    public function teacherInSections()
    {
        return $this->hasMany(TeacherSections::class, 'id_subject', 'id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'id_subject', 'id');
    }
    
}
