<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorAntrianLayananInformasi extends Model
{
    use HasFactory;

    protected $table='nomor_antrian_li';
    protected $fillable = [ 'nomor_urut', 'audio' ];
}
