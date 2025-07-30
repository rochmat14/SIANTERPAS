<?php

namespace App\Http\Controllers\Dashboard\Antrian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\NomorAntrianLayananKunjungan;
use App\Events\AntrianKunjungan1;
use App\Events\AntrianKunjungan2;
use App\Events\AntrianKunjungan3;

class AntrianLayananKunjunganController extends Controller
{
    private $controller = 'sesi_layanan_kunjungan';
    private $title = 'Sesi Layanan Kunjungan';
    
    public function aturAntrian()
    {
        $nomorAntrianSesiPertama = NomorAntrianLayananKunjungan::where('sesi_kunjungan', 'pertama')->paginate(1);
        $nomorAntrianSesiKedua = NomorAntrianLayananKunjungan::where('sesi_kunjungan', 'kedua')->paginate(1);
        $nomorAntrianSesiKetiga = NomorAntrianLayananKunjungan::where('sesi_kunjungan', 'ketiga')->paginate(1);

        return view('backend.antrian.antrianLayananKunjungan', compact('nomorAntrianSesiPertama', 'nomorAntrianSesiKedua', 'nomorAntrianSesiKetiga'));
    }

    public function index()
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        return view('backend.antrian.antrian_kunjungan.sesiKunjungan')->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

    public function sesiPertama()
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $nomorAntrianSesiPertama = NomorAntrianLayananKunjungan::where('sesi_kunjungan', 'pertama')->orderBy('nomor_urut', 'ASC')->simplePaginate(1);;
        if($nomorAntrianSesiPertama->isEmpty()) {
            abort(404);
        }
        
        return view('backend.antrian.antrian_kunjungan.sesi.sesiPertama', compact('nomorAntrianSesiPertama'))->with(['controller'=>$this->controller, 'title'=>'Sesi Pertama']);
    }

    public function storeSesiPertama(Request $request)
    {
        $nomor_urut = $request->nomor_urut;
        
        $array = [
            'nomor_urut' => $nomor_urut,
        ];
        
        AntrianKunjungan1::dispatch($array);
        
        return back();
    }

    public function sesiKedua()
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $nomorAntrianSesiKedua = NomorAntrianLayananKunjungan::where('sesi_kunjungan', 'kedua')->orderBy('nomor_urut', 'ASC')->simplePaginate(1);
        
        if($nomorAntrianSesiKedua->isEmpty()) {
            abort(404);
        }

        return view('backend.antrian.antrian_kunjungan.sesi.sesiKedua', compact('nomorAntrianSesiKedua'))->with(['controller'=>$this->controller, 'title'=>'Sesi Kedua']);
    }

    public function storeSesiKedua(Request $request)
    {
        $nomor_urut = $request->nomor_urut;
        
        $array = [
            'nomor_urut' => $nomor_urut,
        ];
        
        AntrianKunjungan2::dispatch($array);
        
        return back();
    }

    public function sesiKetiga()
    {
        $nomorAntrianSesiKetiga = NomorAntrianLayananKunjungan::where('sesi_kunjungan', 'ketiga')->orderBy('nomor_urut', 'ASC')->simplePaginate(1);
        
        if($nomorAntrianSesiKetiga->isEmpty()) {
            abort(404);
        }
        
        return view('backend.antrian.antrian_kunjungan.sesi.sesiKetiga', compact('nomorAntrianSesiKetiga'))->with(['controller'=>$this->controller, 'title'=>'Sesi Ketiga']);
    }

    public function storeSesiKetiga(Request $request)
    {
        $nomor_urut = $request->nomor_urut;
        
        $array = [
            'nomor_urut' => $nomor_urut,
        ];
        
        AntrianKunjungan3::dispatch($array);
        
        return back();
    }
}
