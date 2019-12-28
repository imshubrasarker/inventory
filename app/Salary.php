<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'employee_id',
        'balance',
        'qty_desc',
        'rate',
        'salary_type',
        'note'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
