<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name', 'balance', 'quantity', 'note', 'address', 'mobile'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'supplier_id');
    }
}
