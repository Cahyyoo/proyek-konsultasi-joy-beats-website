<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class minuman extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pemesanan_makanan() {
        return $this->HasOne(pemesanan_makanan::class);
    }
}
