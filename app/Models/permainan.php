<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permainan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pemesanan_permainan() {
        return $this->HasOne(pemesanan_permainan::class);
    }
}
