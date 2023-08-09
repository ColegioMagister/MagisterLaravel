<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class Weekday extends Model
{
    use HasFactory;
    protected $table='weekdays';

    protected $guarded=[];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'id_weekday', 'id');
    }

}
