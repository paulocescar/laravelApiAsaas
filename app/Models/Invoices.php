<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer',
        'billingType',
        'value',
        'dueDate',
        'description',
        'externalReference',
        'installmentCount',
        'totalValue',
        'installmentValue',
        'discount_id',
        'interest_id',
        'fine_id',
        'postalService',
        'split',
        'lixeira'
    ];
}
