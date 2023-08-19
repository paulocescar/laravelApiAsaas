<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Splits extends Model
{
    use HasFactory;
    protected $fillable = [
        'walletId',
        'fixedValue',
        'percentualValue',
        'lixeira'
    ];
}
