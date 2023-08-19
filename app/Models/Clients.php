<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cpfCnpj',
        'email',
        'phone',
        'mobilePhone',
        'address',
        'addressNumber',
        'complement',
        'province',
        'postalCode',
        'externalReference',
        'notificationDisabled',
        'additionalEmails',
        'municipalInscription',
        'stateInscription',
        'observations',
        'groupName',
        'company',
        'lixeira'
    ];
}
