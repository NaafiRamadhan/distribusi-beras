<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beras extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $keyType = 'string';
    protected $primaryKey = 'id_beras';
}
