<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterMilitante extends Model
{
    use HasFactory;
    protected $table = 'register_militante';
    protected $primaryKey = 'id';

}
