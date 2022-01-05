<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addressee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'birth_date', 'phone1', 'phone2', 'whatsapp_no', 'email', 'email2', 'b_no', 'street', 'landmark', 'village', 'taluka', 'city', 'state', 'country'
    ];
}
