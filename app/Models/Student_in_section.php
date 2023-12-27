<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Student, Section, Schedule};

class Student_in_section extends Model
{
    use HasFactory;
    protected $table = 'student_in_section';
    public function section()
    {
        return $this->hasOne(Section::class, 'id_section', 'id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'id_student', 'id');
    }
    public function attendances()
    {
        return $this->belongsToMany(Schedule::class, 'attendances', 'id_student', 'id_schedule')
            ->withPivot('id', 'status')
            ->withTimestamps();
    }
    protected $guarded = [];
}
