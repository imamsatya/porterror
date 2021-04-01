<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balasan extends Model
{
    use HasFactory;

    public function edcod()
    {
        return $this->belongsTo('App\Models\Foto', 'edcod_id');
    }
}
