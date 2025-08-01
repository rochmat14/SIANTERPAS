<?php

namespace App\Http\Controllers\Dashboard\Antrian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\AntrianInformasi;
use App\Events\TutupAntrianInformasi;
use App\Model\NomorAntrian;
use App\Models\PanggilAntrian;
use App\Model\NomorAntrianLayananInformasi;

class AntrianLayananInformasiController extends Controller
{
    private $controller = 'antrian_layanan_informasi';
    private $title = 'Antrian Layanan Informasi';
    
    // public function index()
    // {
    //     $panggilanAntrian = PanggilAntrian::all();
    //     return view('antrian.backend.antrianLayananInformasi', compact('panggilanAntrian'));
    // }

    // halaman atur antrian 
    public function index()
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }

        $nomorAntrian = NomorAntrianLayananInformasi::orderBy('nomor_urut', 'ASC')->simplePaginate(1);
        
        if($nomorAntrian->isEmpty()) {
            abort(404);
        }
        return view('backend.antrian.antrianLayananInformasi', compact('nomorAntrian'))->with(['controller'=>$this->controller, 'nomorAntrian'=>$nomorAntrian, 'title'=>$this->title]);
    }

    // halaman atur antrian : aksi button panggil antrian selanjutnya
    public function store(Request $request)
    {
        $nomor_urut = $request->nomor_urut;
        
        $array = [
            'nomor_urut' => $nomor_urut,
        ];
        
        AntrianInformasi::dispatch($array);
        
        return back();
    }

    public function tutupAntrian(Request $request)
    {

        return "tutup antrian";
        $tutup = "TUTUP";
        
        $array = [
            'tutup' => $tutup,
        ];
        
        TutupAntrianInformasi::dispatch($array);
        
        return back();
    }
}
