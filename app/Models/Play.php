<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Collection;


class Play extends Model
{
    use HasFactory;
    

    protected $guarded = [];
    //protected $table = 'plays';

    public function presentation()
    {
        return $this->belongsTo(Presentation::class);
    }

    public function slide()
    {
        return $this->belongsTo(Slide::class);
    }
}
