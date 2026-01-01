<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan_permainan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function permainan() {
        return $this->BelongsTo(permainan::class);
    }
}
