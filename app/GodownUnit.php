<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GodownUnit extends Model
{
    protected $fillable = [
        'unit_name', 'unit_number'
    ];
}
