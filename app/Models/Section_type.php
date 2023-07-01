<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sections;
class Section_type extends Model
{
    use HasFactory;

    protected $table='section_type';

    public function section(){
        return $this->belongsTo(Sections::class,'id_sectiontype','id');
    }
    protected $guarded=[];
}
