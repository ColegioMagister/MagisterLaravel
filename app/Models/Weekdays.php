<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedules;
class Weekdays extends Model
{
    use HasFactory;
    protected $table='weekdays';

    protected $guarded=[];

    public function schedules()
    {
        return $this->belongsToMany(Schedules::class,'schedules');
    }

}
