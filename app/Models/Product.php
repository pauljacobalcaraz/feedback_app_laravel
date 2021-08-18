<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function status()
    {
        return $this->belongsTo('\App\Models\Status');
    }
    public function company()
    {
        return $this->belongsTo('\App\Models\Company');
    }
    public function label()
    {
        return $this->belongsTo('\App\Models\Label');
    }
}
