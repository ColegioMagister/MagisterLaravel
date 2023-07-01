<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Quotas,Student_in_section};
class Student_quota extends Model
{
    use HasFactory;
    protected $table='student_quota';
    public function quotas(){
        return $this->hasMany(Quotas::class,'id_quota','id');
    }
    public function studentSection(){
        return $this->hasMany(Student_in_section::class,'id_student','id');
    }
    protected $guarded=[];

}
