<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Employee,Subjects};
class Teacher_has_subjects extends Model
{
    use HasFactory;
    protected $table='teacher_has_subjects';

    

    protected $guarded=[];
}
