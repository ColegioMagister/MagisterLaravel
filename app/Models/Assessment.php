<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Student_has_assessments,Sections,Assessment_type,Subjects};
class Assessment extends Model
{
    use HasFactory;
    protected $table='assessment';
    public function subject(){
        
    }
    public function sections(){
        
    }
    public function assessmentType(){
        
    }
    public function studentAssessment(){
        return $this->belongsTo(Student_has_assessments::class,'id_assessment','id');
    }

    protected $guarded=[];

}
