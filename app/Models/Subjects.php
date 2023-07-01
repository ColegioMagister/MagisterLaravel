<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Teacher_has_subjects,Assessment,Schedules,Section_has_subjects};
class Subjects extends Model
{
    use HasFactory;
    protected $table='subjects';

    public function teacherSubjects(){
        return $this->belongsToMany(Teacher_has_subjects::class,'teacher_has_subjects');
    }
    public function assessment(){
        return $this->belongsToMany(Assessment::class,'assessment');
    }
    public function schedules(){
        return $this->belongsToMany(Schedules::class,'schedules');
    }
    public function sectionSubjects(){
        return $this->belongsToMany(Section_has_subjects::class,'section_has_subjects');
    }
    protected $guarded=[];
}
