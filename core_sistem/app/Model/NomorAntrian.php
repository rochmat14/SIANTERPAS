<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorAntrian extends Model
{
    use HasFactory;

    protected $table='nomor_antrian';
    protected $fillable = [ 'nomor_urut' ];
}
