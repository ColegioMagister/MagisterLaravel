<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Student_has_assessments,Section};
class Student extends Model
{
    use HasFactory;
    protected $table='student';
    protected $guarded=[];

    public function studentAssessment(){
        return $this->belongsTo(Student_has_assessments::class,'id_student','id');
    }

    public function studentSections()
    {
        return $this->belongsToMany(Section::class, 'student_in_section', 'id_student', 'id_section')
                                    ->withPivot(['id', 'status'])->withTimestamps();
    }

   
}
