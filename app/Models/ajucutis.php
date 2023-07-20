<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ajucutis extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'id_users',
        'mulai_cuti',
        'selesai_cuti',
        'alasan',
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_ajucuti', 'ajucuti_id', 'user_id');
    }
}
