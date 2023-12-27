<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Section,
    Weekday,
    Subject,
    Student_in_section
};

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';
    protected $guarded = [];

    public function weekday()
    {
        return $this->belongsTo(Weekday::class, 'id_weekday', 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'id_section', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'id_subject', 'id');
    }
    public function attendances()
    {
        return $this->belongsToMany(Student_in_section::class, 'attendances', 'id_schedule', 'id_student')
            ->withPivot('id', 'status')
            ->withTimestamps();
    }
}

