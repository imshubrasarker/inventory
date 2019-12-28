<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
       'name',
       'address',
       'mobile',
       'nid_no',
       'e_contact',
       'salary_type',
       'previous_salary',
       'previous_quantity',
       'balance',
       'salary'
    ];

    public function expenses()
    {
        return $this->belongsTo(Expense::class, 'employee_id');
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class, 'employee_id');
    }
}
