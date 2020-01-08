<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GodownUnit extends Model
{
    protected $fillable = [
        'unit_name', 'unit_number', 'product_id'
    ];

    public function godown2() {
        return $this->hasMany(Godown2::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
