<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fines extends Model
{
    use HasFactory;
    protected $fillable = [
        'value',
        'lixeira'
    ];
}
