<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
class Roles extends Model
{
    use HasFactory;
    protected $table='roles';

    public function employee()
    {
        return $this->belongsTo(Employee::class,'id_role','id');
    }

    protected $guarded=[];

}
