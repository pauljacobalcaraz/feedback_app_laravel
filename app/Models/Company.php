<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function status()
    {
        return $this->belongsTo('\App\Models\Status');
    }
    public function products()
    {
        return $this->hasMany('\App\Models\Product');
    }
}
