<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_asaas_id',
        'name',
        'cpfCnpj',
        'password',
        'email',
        'trial',
        'premium',
        'lixeira'
    ];
}
