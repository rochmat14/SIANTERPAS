<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Gallery;
use App\Model\GalleryImages;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    private $controller = 'gallery';
    private $title = 'Data Gallery';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        if (!$user->can($this->controller.'-index')){
            return view('errors.401');    
        }

        return view('backend.'.$this->controller.'.index')->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

    public function getData(Request $request)
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $arrColumns = [
            1=>'id', 
            2=>'title', 
            3=>'category',
            4=>'file_image'
        ];


        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = Gallery::select([
            'id',
            'title',
            'description',
            'category',
            'file_image'
        ])
        ->where('status',1)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('file_image', function ($row) {
                return $row->file_image;
            })
            ->addColumn('editUrl', function ($row) {
                $url = url('dashboard/gallery/'.$row->id.'/edit');
                return $url;

            })
            ->addColumn('deleteUrl', function ($row) {
                return $row->id;
            })
            ->make();
    }

    public function create(){
        $user = auth()->user();
        if (!$user->can($this->controller.'-create')){
            return view('errors.401');    
        }

        return view('backend.'.$this->controller.'.create')->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }


    public function store(Request $request){
        $user = auth()->user();
        if (!$user->can($this->controller.'-create')){
            return view('errors.401');    
        }

        // saving data
        $title = $request->title;
        $category = $request->category;
        $description = $request->description;
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

        $save_data = new Gallery;
        $save_data->slug = $slug;
        $save_data->title = $title;
        $save_data->category = $category;
        $save_data->description = $description;
        
        if($request->file_image){
            // upload logo bank
            $file_image = $request->file_image;
            $destinationPath = 'images/gallery/';
            $filename = time().'.'.$request->file_image->extension();  
            $request->file_image->move($destinationPath, $filename);
            $save_data->file_image = $filename;

        }
        $save_data->created_by = Auth::user()->id;
        $save_data->save();


        // saving data gallery images
        if($request->hasfile('fasilitas_gallery'))
         {
            $data=array();
            $no=1;
            foreach($request->file('fasilitas_gallery') as $file)
            {
                $file_name = time().'-'.$no++.'.'.$file->extension();

                $destinationPathImages = 'images/fasilitas_gallery/';
                $file->move($destinationPathImages, $file_name);  
                
                // saving data gallery images
                $save = new GalleryImages;
                $save->id_gallery = $save_data->id;
                $save->fasilitas_gallery = $file_name;
                $save->created_by = Auth::user()->id;
                $save->save();
            }

            
         }

        return redirect('/dashboard/'.$this->controller)->with('status', __( 'main.data_has_been_added', ['page' => $this->title] ) );

    }


    public function edit($id){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $data_gallery  = Gallery::where('id',$id)->first();

        
        return view('backend.'.$this->controller.'.edit',compact('data_gallery'))
        ->with(['controller'=>$this->controller, 'title'=>$this->title]);


    }


    public function update(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }


        $id = $request->id;
        $title = $request->title;
        $description = $request->description;
        $category = $request->category;
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

        //update 
        $pk = Gallery::find($id);
        $pk->slug = $slug;
        $pk->title = $title;
        $pk->category = $category;
        $pk->description = $description;
        if($request->file_image){
            // upload gallery images
            $file_image = $request->file_image;
            $destinationPath = 'images/gallery/';
            $filename = time().'.'.$request->file_image->extension();  
            $request->file_image->move($destinationPath, $filename);
            $pk->file_image = $filename;

        }
        $pk->updated_by =Auth::user()->id;
        $pk->save();

        return redirect('/dashboard/'.$this->controller)->with('status', __( 'main.data_has_been_updated', ['page' => $this->title] ) );

    }

    public function delete(Request $request){
        if (!auth()->user()->can($this->controller.'-delete')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        //update  
        $pk = Gallery::find($id);
        $pk->status = 0;
        $pk->updated_by =Auth::user()->id;
        $pk->save();


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
