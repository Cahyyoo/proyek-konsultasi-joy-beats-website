<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barcode extends Model
{
    use HasFactory;

    protected $fillable = [
        'img',
        'ket_barcode',
        'uuid'
    ];

}
