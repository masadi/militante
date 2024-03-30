<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membru extends Model
{
    use HasFactory;
    protected $table = 'membru';
    protected $primaryKey = 'id';

}
