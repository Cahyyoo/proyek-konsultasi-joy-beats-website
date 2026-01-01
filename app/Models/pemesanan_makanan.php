<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan_makanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_makanans';

    protected $fillable = [
        'barcode_id',
        'kode_transaksi',
        'makanan_id',
        'minuman_id',
        'qty',
        'jumlah_harga',
        'detail',
        'ket',
    ];

    public function makanan() {
        return $this->BelongsTo(makanan::class);
    }

    public function minuman() {
        return $this->BelongsTo(minuman::class);
    }
}
