<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkat_pendidikan extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'tingkat_pendidikan';
	protected $primaryKey = 'tingkat_pendidikan_id';
	protected $guarded = [];
}
