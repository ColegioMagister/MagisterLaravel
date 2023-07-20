<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;

class Level extends Model
{
    use HasFactory;

    protected $table='levels';

    public function sections(){
        return $this->hasMany(Section::class,'id_level','id');
    }

    protected $guarded=[];

}
