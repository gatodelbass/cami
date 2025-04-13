<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Collection;


class Presentation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

   
}