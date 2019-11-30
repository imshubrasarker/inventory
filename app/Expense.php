<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['title', 'date', 'expenses_heads_id', 'note','amount'];

    public function expenseHead() {
        return $this->belongsTo(ExpensesHead::class, 'expenses_heads_id');
    }
}
