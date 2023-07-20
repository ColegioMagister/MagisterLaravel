<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;

class SchoolPeriod extends Model
{
    use HasFactory;
    protected $table='school_periods';

    public function sections(){
        return $this->hasMany(Section::class,'id_period','id');
    }

    protected $guarded=[];
}

