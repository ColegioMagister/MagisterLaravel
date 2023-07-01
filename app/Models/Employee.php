<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User,Roles,Teacher_has_subjects};
class Employee extends Model
{
    use HasFactory;

    protected $table='employees';
    public function user(){
        return $this->hasOne(User::class,'id_employee','id');
    }
    public function roles(){
        return $this->belongsTo(Roles::class,'id_role','id');
    }
    public function teacherSubjects(){
        return $this->belongsToMany(Teacher_has_subjects::class,'teacher_has_subjects');
    }

    protected $guarded=[];
}
