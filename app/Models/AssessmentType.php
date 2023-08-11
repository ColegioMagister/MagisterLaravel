<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Assessment;

class AssessmentType extends Model
{
    use HasFactory;
    protected $table='assessment_type';
    protected $guarded = [];

    public function assessments(){

        return $this->hasMany(Assessment::class, 'id_assessment_type', 'id');
    }

}
