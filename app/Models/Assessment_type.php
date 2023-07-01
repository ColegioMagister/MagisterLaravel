<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Assessment;
class Assessment_type extends Model
{
    use HasFactory;
    protected $table='assessments_type';

    public function assessment(){
        return $this->belongsTo(Assessment::class,'id_assessment_type','id');
    }
    protected $guarded=[];

}
