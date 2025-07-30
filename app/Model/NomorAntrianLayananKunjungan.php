<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorAntrianLayananKunjungan extends Model
{
    use HasFactory;

    protected $table='nomor_antrian_lk';
    protected $fillable = [ 'sesi_kunjungan', 'nomor_urut', 'audio' ];
}
