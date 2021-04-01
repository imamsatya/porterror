<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edcod extends Model
{
    use HasFactory;

    public function fotos()
    {
        return $this->hasMany('App\Models\Foto', 'edcod_id');
    }

    public function balasans()
    {
        return $this->hasMany('App\Models\Balasan', 'edcod_id');
    }
}
