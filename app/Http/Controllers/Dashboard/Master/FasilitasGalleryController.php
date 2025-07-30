<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GalleryImages;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Backend\FasilitasGalleryRequest;
use Illuminate\Support\Facades\File; 



class FasilitasGalleryController extends Controller
{
    
    private $controller = 'fasilitas';

    public function getData(Request $request)
    {
        
        $arrColumns = [
            1=>'id', 
            2=>'id_gallery', 
            3=>'fasilitas_gallery'
        ];


        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = GalleryImages::select([
            'id',
            'id_gallery',
            'fasilitas_gallery'
        ])
        ->where('id_gallery',$request->id_gallery)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('fasilitas_gallery', function ($row) {
                return $row->fasilitas_gallery;
            })
            ->addColumn('editUrl', function ($row) {
                return $row->id;
            })
            ->addColumn('deleteUrl', function ($row) {
                return $row->id;
            })
            ->make();
    }


    public function save(FasilitasGalleryRequest $request){
        

        $id_gallery = $request->get('id_gallery');

        //saving table
        $data = new GalleryImages;
        $data->id_gallery = $id_gallery;
        
        if($request->fasilitas_gallery){
            // upload logo bank
            $fasilitas_gallery = $request->fasilitas_gallery;
            $destinationPath = 'images/fasilitas_gallery/';
            $filename = time().'.'.$request->fasilitas_gallery->extension();  
            $request->fasilitas_gallery->move($destinationPath, $filename);
            $data->fasilitas_gallery = $filename;

        }
        $data->created_by = Auth::user()->id;
        $data->save();
        echo json_encode(array("status" => TRUE));


    }

    public function delete(Request $request){
        
        $id = $request->get('id');
        $get_data = GalleryImages::where('id',$id)->first();
        $file_path = public_path().'/images/fasilitas_gallery/'.$get_data->fasilitas_gallery;

        if (File::exists($file_path)) {
            unlink($file_path);
        }
        $pk = GalleryImages::find($id);
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
