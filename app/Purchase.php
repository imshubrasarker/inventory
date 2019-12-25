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
        'category_id',
        'amount',
        'note',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
