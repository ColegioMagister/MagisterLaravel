<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Student,Sections,Student_quota};
class Student_in_section extends Model
{
    use HasFactory;
    protected $table='student_in_section';
    public function studentQuota(){
        return $this->hasOne(Student_quota::class,'id_student','id');
    }
    public function section(){
        return $this->hasOne(Sections::class,'id_section','id');
    }
    public function student(){
        return $this->belongsTo(Student::class,'id_student','id');
    }
    protected $guarded=[];
}
