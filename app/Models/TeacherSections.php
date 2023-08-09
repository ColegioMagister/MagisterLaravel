<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Employee,
                Subject,
                Section
                };

class TeacherSections extends Model
{
    use HasFactory;

    protected $table='teacher_in_sections';
    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo(Employee::class, 'id_teacher', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'id_subject', 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'id_section', 'id');
    }
}
