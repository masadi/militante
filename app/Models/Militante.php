<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Militante extends Model
{
    use HasFactory;
    protected $table = 'militante';
    protected $primaryKey = 'id';

}
