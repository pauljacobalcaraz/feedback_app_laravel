<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }
    public function product()
    {
        return $this->belongsTo('\App\Models\Product');
    }
    public function label()
    {
        return $this->belongsTo('\App\Models\Label');
    }
    public function votes()
    {
        return $this->hasMany('\App\Models\Vote');
    }
    public function comments()
    {
        return $this->hasMany('\App\Models\Comment');
    }
    public function action()
    {
        return $this->belongsTo('\App\Models\Action');
    }
}
