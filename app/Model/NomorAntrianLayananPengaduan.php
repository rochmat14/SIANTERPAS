<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorAntrianLayananPengaduan extends Model
{
    use HasFactory;

    protected $table='nomor_antrian_lp';
    protected $fillable = [ 'nomor_urut', 'audio' ];
}
