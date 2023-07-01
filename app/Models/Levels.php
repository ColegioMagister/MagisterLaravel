<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sections;
class Levels extends Model
{
    use HasFactory;

    protected $table='employees';
    public function sections(){
        return $this->belongsTo(Sections::class,'id_level','id');
    }
    protected $guarded=[];

}
