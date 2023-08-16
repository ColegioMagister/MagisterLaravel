<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{SchoolPeriod,
                Level,
                SectionType,
                Student,
                Subject,
                TeacherSections,
                Schedule,
                Assessment
            };

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $guarded=[];


    public function school_period()
    {
        return $this -> belongsTo(SchoolPeriod::class, 'id_period', 'id');
    }
    
    public function level()
    {
        return $this -> belongsTo(Level::class, 'id_level', 'id');
    }

    public function section_type()
    {
        return $this -> belongsTo(SectionType::class, 'id_sectiontype', 'id');
    }

    public function studentSections()
    {
        return $this->belongsToMany(Student::class, 'student_in_section', 'id_section', 'id_student')
                                    ->withPivot(['id', 'status'])->withTimestamps();
    }

    public function subjectSection()
    {
        return $this->belongsToMany(Subject::class, 'section_has_subjects', 'id_section', 'id_subject')
                                    ->withPivot('id')->withTimestamps();
    }

    public function teacherInSections()
    {
        return $this->hasMany(TeacherSections::class, 'id_section', 'id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'id_section', 'id');
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'id_section', 'id');
    }
}
