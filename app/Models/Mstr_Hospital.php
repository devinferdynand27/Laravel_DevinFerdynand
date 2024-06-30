<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mstr_Hospital extends Model
{
    use HasFactory;

    public function patients()
    {
        return $this->hasMany(Pasien::class, 'hospital_id');
    }


    protected $fillable = [
        'hospital_name',
        'address',
        'email',
        'telephone'
    ];
}
