<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockData extends Model
{
        /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stock_data';

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
    protected $fillable = ['product_id', 'add_stock', 'sale_stock', 'balance'];
}
