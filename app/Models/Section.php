<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{SchoolPeriod,Level,SectionType};

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';

    public function school_period()
    {
        return $this -> belongsTo(SchoolPeriod::class, 'id_period', 'id');
    }
    
    public function level()
    {
        return $this -> belongsTo(Level::class, 'id_level', 'id');
    }

    public function section_type()
    {
        return $this -> belongsTo(SectionType::class, 'id_sectiontype', 'id');
    }

    protected $guarded=[];
}
