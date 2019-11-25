<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

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
    protected $fillable = ['name', 'image', 'primary_mobile', 'alter_mobile', 'address', 'email', 'due', 'quantity', 'note'];
    
    public function invoices () {
        return $this->hasMany('App\Invoice');
    }
    
    public function payments () {
        return $this->hasMany('App\Payment');
    }
    
    

    
}
