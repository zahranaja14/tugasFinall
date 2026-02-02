<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'produk',
        'jumlah',
        'harga_satuan',
        'total',
        'status',
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
