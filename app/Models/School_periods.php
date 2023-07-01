<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sections;
class School_periods extends Model
{
    use HasFactory;
    protected $table='school_periods';
    public function sections(){
        return $this->belongsTo(Sections::class,'id_period','id');
    }

    protected $guarded=[];
}
