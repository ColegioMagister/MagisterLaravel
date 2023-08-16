<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Subject,Section};


class Section_has_subjects extends Model
{
    use HasFactory;
    protected $table='section_has_subjects';
    public function subjects(){
        return $this->belongsTo(Subject::class, 'id_subject', 'id');
    }
    public function sections(){
        return $this->belongsTo(Section::class, 'id_section', 'id');
    }

    protected $guarded=[];


}
