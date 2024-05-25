<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModifyEmailRequest extends Model
{
    use HasFactory;

      protected $fillable = [
        'user_id', 'new_email', 'token',
    ];

}
