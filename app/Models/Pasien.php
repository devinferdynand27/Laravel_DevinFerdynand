<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    public function hospital()
    {
        return $this->belongsTo(Mstr_Hospital::class, 'hospital_id'); 
    }
    
}

