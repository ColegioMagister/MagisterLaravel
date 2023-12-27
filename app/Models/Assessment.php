<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Section, AssessmentType, Subject, Student};

class Assessment extends Model
{
    use HasFactory;
    protected $table = 'assessment';
    protected $guarded = [];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'id_subject', 'id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'id_section', 'id');
    }
    public function assessmentType()
    {
        return $this->belongsTo(AssessmentType::class, 'id_assessment_type', 'id');
    }

    public function studentAssessment()
    {
        return $this->belongsToMany(Student::class, 'student_has_assessments', 'id_assessment', 'id_student')
            ->withPivot('id', 'grade', 'status')->withTimestamps();
    }


}
