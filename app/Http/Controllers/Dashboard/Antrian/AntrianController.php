<?php

namespace App\Http\Controllers\Dashboard\Antrian;

use App\Http\Controllers\Controller;

use App\Model\NomorAntrian;
use App\Models\PanggilAntrian;

class AntrianController extends Controller
{
    private $controller = 'category';
    
    public function index()
    {
        $panggilanAntrian = PanggilAntrian::all();
        return view('antrian.index', compact('panggilanAntrian'));
    }

    // halaman atur antrian 
    public function aturAntrian()
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $nomorAntrian = NomorAntrian::paginate(1);
        return view('backend.antrian.pilihLayanan', compact('nomorAntrian'))->with(['controller'=>$this->controller, 'nomorAntrian'=>$nomorAntrian]);
    }

    public function antrianLayananInformasi()
    {
        $nomorAntrian = NomorAntrian::paginate(1);
        return view('antrian.backend.antrianLayananInformasi', compact('nomorAntrian'));
    }
}
