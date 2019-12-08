<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Purchase extends Model
{
    protected $fillable = [
        'sl',
        'date',
        'supplier_id',
        'address',
        'mobile',
        'invoice_num',
        'quantity',
        'description',
        'amount',
        'note',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
