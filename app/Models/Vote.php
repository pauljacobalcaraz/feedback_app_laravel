<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    public function feedback()
    {
        return $this->belongsTo('\App\Models\Feedback');
    }
}
