<?php

namespace App\Http\Controllers\Dashboard\Antrian;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\NomorAntrianLayananPengaduan;

use App\Events\AntrianPengaduan;

class AntrianLayananPengaduanController extends Controller
{
    private $controller = 'antrian_layanan_pengaduan';
    private $title = 'Antrian Layanan Pengaduan';
    
    public function aturAntrian()
    {
        $nomorAntrian = NomorAntrianLayananPengaduan::orderBy('nomor_urut', 'ASC')->simplePaginate(1);

        if($nomorAntrian->isEmpty()) {
            abort(404);
        }
        
        return view('backend.antrian.antrianLayananPengaduan', compact('nomorAntrian'))->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

    public function store(Request $request)
    {
        $nomor_urut = $request->nomor_urut;

        $array = [
            'nomor_urut' => $nomor_urut,
        ];
        
        AntrianPengaduan::dispatch($array);

        return back();
    }
}
