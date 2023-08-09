<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User,Roles, Subject, TeacherSections};

class Employee extends Model
{
    use HasFactory;

    protected $table='employees';
    protected $guarded=[];

    public function user()
    {
        return $this->hasOne(User::class,'id_employee','id');
    }

    public function roles()
    {
        return $this->belongsTo(Roles::class,'id_role','id');
    }

    public function teacherSubjects()
    {
        return $this->belongsToMany(Subject::class,'teacher_has_subjects', 'id_teacher', 'id_subject')
                                    ->withPivot('id')->withTimestamps();
    }

    public function teacherInSections()
    {
        return $this->hasMany(TeacherSections::class, 'id_teacher', 'id');
    }
}
