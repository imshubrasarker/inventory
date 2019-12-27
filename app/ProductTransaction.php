<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    protected $fillable = ['godown2s_id', 'add_qty', 'leave_qty'];

    public function godown2s()
    {
        return $this->belongsTo(Godown2::class, 'godown2s_id');
    }
}
