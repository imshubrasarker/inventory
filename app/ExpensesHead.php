<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesHead extends Model
{
    protected $fillable = ['title'];

    public function expenses() {
        return $this->hasMany(Expense::class, 'expenses_heads_id');
    }
}
