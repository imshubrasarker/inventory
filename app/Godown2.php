<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Godown2 extends Model
{
    protected $fillable = [
        'name', 'size', 'godown_unit_id', 'qty', 'date', 'note'
    ];

    public function godownUnits()
    {
        return $this->belongsTo(GodownUnit::class, 'godown_unit_id');
    }
}
