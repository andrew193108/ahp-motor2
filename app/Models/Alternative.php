<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_motor',
        'harga_motor',
        'konsumsi_bbm',
        'biaya_maintenance',
        'dimensi_motor',
        'kapasitas_mesin',
    ];
}
