<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Student,Assessment};
class Student_has_assessments extends Model
{
    use HasFactory;

    protected $table='student_has_assessments';
    public function student(){
        return $this->belongsTo(Student::class,'id_student','id');
    }
    public function assessment(){
        return $this->belongsTo(Assessment::class,'id_assessment','id');
    }
    protected $guarded=[];
}
