<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    public function edcod()
    {
        return $this->belongsTo('App\Models\Foto', 'edcod_id');
    }

}
