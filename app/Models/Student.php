<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Section, Assessment};

class Student extends Model
{
    use HasFactory;
    protected $table = 'student';
    protected $guarded = [];

    public function studentSections()
    {
        return $this->belongsToMany(Section::class, 'student_in_section', 'id_student', 'id_section')
            ->withPivot(['id', 'status'])->withTimestamps();
    }

    public function studentAssessment()
    {
        return $this->belongsToMany(Assessment::class, 'student_has_assessments', 'id_student', 'id_assessment')
            ->withPivot('id', 'grade', 'status')->withTimestamps();
        ;
    }
}
