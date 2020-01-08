<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'size', 'buy_price', 'sale_price', 'unit_id', 'category_id', 'discount', 'description', 'alert_quantity', 'final_price'];

    public function godown2()
    {
        return $this->hasMany(Product::class, 'product_id');
    }
    public function godownUnits()
    {
        return $this->hasMany(GodownUnit::class, 'product_id');
    }

    
}
