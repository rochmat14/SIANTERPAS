<?php

namespace App\Http\Controllers\Dashboard\Antrian;

use App\Http\Controllers\Controller;
use App\Model\NomorAntrianLayananKunjungan;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

class KelolaDataAntrianLayananKunjunganController extends Controller
{
    private $controller = 'kelola_antrian_layanan_kunjungan';
    private $title = 'Kelola Antrian Layanan Kunjungan';
    
    public function index()
    {
        $nomorAntrian = NomorAntrianLayananKunjungan::paginate(1);
        
        return view('backend.data_antrian.antrianLayananKunjungan', compact('nomorAntrian'))->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = NomorAntrianLayananKunjungan::orderBy('nomor_urut', 'Desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($hasil) {
                    return [
                        $hasil->id
                    ];
                })
                ->rawColumns(['id'])
                ->make(true);
        }
    }

    public function create(Request $request)
    {
        if (!auth()->user()->can($this->controller.'-create')){
            return view('errors.401');    
        }

        $nomor_urut = $request->get('nomor_urut');

        $data = new NomorAntrianLayananKunjungan();
        $data->nomor_urut = $nomor_urut;

        // upload file audio
        $sesi_kunjungan = $request->get('sesi_kunjungan');
        
        if($sesi_kunjungan == 'pertama'){
            $destinationPath = 'audio/layanan_kunjungan/sesi_pertama';
        }else if($sesi_kunjungan == 'kedua') {
            $destinationPath = 'audio/layanan_kunjungan/sesi_kedua';
        }else{
            $destinationPath = 'audio/layanan_kunjungan/sesi_ketiga';
        }
        $filename = $nomor_urut.'.'.$request->audio->extension();
        $request->audio->move($destinationPath, $filename);
        $data->audio = $filename;
        $data->sesi_kunjungan = $sesi_kunjungan;
        $data->save();

        echo json_encode(array("status" => TRUE));
    }


    // show data where id on form edit
    public function get_data_byid(Request $request){
        $id= $request->get('id');

        $data = NomorAntrianLayananKunjungan::select(
            'id',
            'nomor_urut',
            'sesi_kunjungan',
            'audio'
        )
        ->where('id',$id)->first();
        
        $data =array('data'=>$data);
        return response()->json($data);
    }

    // show option sesi kunjunga make jquery
    public function showSesiKunjungan($id)
    {   
        $sesi_kunjungan = NomorAntrianLayananKunjungan::where('id', $id)->get();

        return json_encode($sesi_kunjungan);
    }
    
    // action edit
    public function update(Request $request)
    {
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $id              = $request->get('id');
        $nomor_urut      = $request->get('nomor_urut');
        $sesi_kunjungan  = $request->get('sesi_kunjungan');

        //update 
        $pk = NomorAntrianLayananKunjungan::find($id);
        $pk->nomor_urut      = $nomor_urut;
        
        if($request->audio){
            $checkFileS1 =  public_path().'/audio/layanan_kunjungan/sesi_pertama/'.$pk->audio;
            $checkFileS2 =  public_path().'/audio/layanan_kunjungan/sesi_kedua/'.$pk->audio;
            $checkFileS3 =  public_path().'/audio/layanan_kunjungan/sesi_ketiga/'.$pk->audio;

            if(file_exists($checkFileS1)) {
                @unlink($checkFileS1);
            }

            if(file_exists($checkFileS2)) {
                @unlink($checkFileS2);
            }

            if(file_exists($checkFileS3)) {
                @unlink($checkFileS3);
            }
            
            // upload audio
            if($sesi_kunjungan == 'pertama'){
                $destinationPath = 'audio/layanan_kunjungan/sesi_pertama/';
            }

            if($sesi_kunjungan == 'kedua'){
                $destinationPath = 'audio/layanan_kunjungan/sesi_kedua/';
            }

            if($sesi_kunjungan == 'ketiga'){
                $destinationPath = 'audio/layanan_kunjungan/sesi_ketiga/';
            }

            $filename = $nomor_urut.'.'.$request->audio->extension();
            $request->audio->move($destinationPath, $filename);
            
            $pk->audio = $filename;
        }
        
        $pk->save();
        echo json_encode(array("status" => TRUE));
    }

    public function delete(Request $request){
        if (!auth()->user()->can($this->controller.'-delete')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        //update  
        $pk = NomorAntrianLayananKunjungan::find($id);


        $checkFileS1 =  public_path().'/audio/layanan_kunjungan/sesi_pertama/'.$pk->audio;
        $checkFileS2 =  public_path().'/audio/layanan_kunjungan/sesi_kedua/'.$pk->audio;
        $checkFileS3 =  public_path().'/audio/layanan_kunjungan/sesi_ketiga/'.$pk->audio;

        if(file_exists($checkFileS1)) {
            @unlink($checkFileS1);
        }

        if(file_exists($checkFileS2)) {
            @unlink($checkFileS2);
        }

        if(file_exists($checkFileS3)) {
            @unlink($checkFileS3);
        }
        
        $pk->delete();
        $result=array(
                "data_post"=>array(
                    "status"=>TRUE,
                    "class" => "success",
                    "message"=>"Success ! Deleted data"
                )
            );
        echo json_encode($result);
    }
}
