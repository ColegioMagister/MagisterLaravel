<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Student_quota,Sections};
class Quotas extends Model
{
    use HasFactory;
    protected $table='quotas';
    public function studentQuota(){
        return $this->belongsTo(Student_quota::class,'id_quota','id');
    }
    public function sections(){
        return $this->belongsToMany(Sections::class,'sections');
    }
    protected $guarded=[];


}
