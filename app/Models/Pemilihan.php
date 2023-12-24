<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilihan extends Model
{
    use HasFactory;
    protected $table = 'pemilihan';

    protected $fillable = [
        'id',
        'id_capresma',
        'nim',
        'created_at',
    ];
}
