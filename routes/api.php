<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Master\BarangjasaController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

// start auth
Route::get('/', function() {
    $data = [
        'API Name' => "Base API System ". date('Y'),
        'Version' => '1.0.0',
        'Powered By' => 'IE Indonesia'
    ];
    return response()->json($data, 200);
});

