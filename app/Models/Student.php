<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Student_has_assessments,Student_in_section};
class Student extends Model
{
    use HasFactory;
    protected $table='student';

    public function studentAssessment(){
        return $this->belongsTo(Student_has_assessments::class,'id_student','id');
    }

    public function studentSection(){
        return $this->belongsTo(Student_in_section::class,'id_student','id');
    }
    protected $guarded=[];
}
