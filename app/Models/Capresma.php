<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capresma extends Model
{
    use HasFactory;
    
    protected $table = 'capresma';

    protected $fillable = [
        'id',
        'nm_capresma',
        'wakil',
        'visi',
        'misi',
        'fakultas',
        'foto_url',
        'jumlah_vote',
    ];
}
