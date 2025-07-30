<?php

namespace App\Http\Controllers\Dashboard\Antrian;

use App\Http\Controllers\Controller;
use App\Model\NomorAntrianLayananInformasi;

use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;

class KelolaDataAntrianLayananInformasiController extends Controller
{
    //
    private $controller = 'kelola_antrian_layanan_informasi';
    private $title = 'Kelola Antrian Layanan Informasi';
    
    public function index()
    {
        $user = auth()->user();
        if (!$user->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $nomorAntrian = NomorAntrianLayananInformasi::orderBy('nomor_urut', 'desc')->get();

        return view('backend.data_antrian.antrianLayananInformasi', compact('nomorAntrian'))->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

   public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = NomorAntrianLayananInformasi::orderBy('id', 'Desc')->get();

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

        $data = new NomorAntrianLayananInformasi;
        $data->nomor_urut = 'I'.$nomor_urut;

        // upload file audio
        $destinationPath = 'audio/layanan_informasi';
        $filename = 'I'.$nomor_urut.'.'.$request->audio->extension();
        $request->audio->move($destinationPath, $filename);
        $data->audio = $filename;
        $data->save();

        echo json_encode(array("status" => TRUE));
    }

    // show data where id on form edit
    public function get_data_byid(Request $request){

        $id= $request->get('id');

        $data = NomorAntrianLayananInformasi::select(
            'id',
            'nomor_urut',
            'audio'
        )
        ->where('id',$id)->first();
        
        $data_return =array('data'=>$data);
        return response()->json($data_return);
    }

    // action edit
    public function update(Request $request)
    {
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $id              = $request->get('id');
        $nomor_urut      = $request->get('nomor_urut_edit');

        //update 
        $pk = NomorAntrianLayananInformasi::find($id);
        $pk->nomor_urut      = 'I'.$nomor_urut;
        
        if($request->audio){
            $checkFile =  public_path().'/audio/layanan_informasi/'.$pk->audio;
            if(file_exists($checkFile)) {
                @unlink($checkFile);
            }
            // upload audio
            $destinationPath = 'audio/layanan_informasi';
            $filename = 'I'.$nomor_urut.'.'.$request->audio->extension();
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
        $pk = NomorAntrianLayananInformasi::find($id);

        $checkFile =  public_path().'/audio/layanan_informasi/'.$pk->audio;
        if(file_exists($checkFile)) {
            @unlink($checkFile);
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
