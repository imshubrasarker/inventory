<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Godown2 extends Model
{
    protected $fillable = [
        'product_id', 'size', 'godown_unit_id', 'qty', 'date', 'note'
    ];

    public function godownUnits()
    {
        return $this->belongsTo(GodownUnit::class, 'godown_unit_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
