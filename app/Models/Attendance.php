<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Schedule,Student_in_section};
class Attendance extends Model
{
    use HasFactory;
    protected $table='attendances';
    public function schedules(){
        return $this->belongsTo(Schedule::class,'id_schedule','id');
    }
    public function studentSections(){
        return $this->belongsTo(Student_in_section::class,'id_student','id');
    }
    protected $guarded=[];

}
