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
        'note',
        'month',
        'working_day',
        'paid_salary'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
