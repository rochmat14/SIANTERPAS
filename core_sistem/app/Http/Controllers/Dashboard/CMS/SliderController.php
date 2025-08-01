<?php

namespace App\Http\Controllers\Dashboard\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Slideshow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Backend\SlideshowFormRequest;



class SliderController extends Controller
{
    private $controller = 'slider';
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    private function title(){
        return __('main.slideshow');
    }

    public function index(Request $request)
    {
        if (!Auth::user()->can($this->controller.'-index')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }
        
        $user = Auth::user();
        return view('backend.'.$this->controller.'.index', compact('user'))->with(array('controller' => $this->controller, 'title' => $this->title()));

    }


    public function getData(Request $request)
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $arrColumns = [1=>'id', 2=>'title',3=>'subtitle'];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = Slideshow::where('status',1)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->escapeColumns('active')
            ->addColumn('image', function ($row) {

                $image  = "<img src='".url('images/slideshow').'/'.$row->image."' width='100'>";
                return $image;
            })
            ->addColumn('image_mobile', function ($row) {

                $image_mobile  = "<img src='".url('images/slideshow').'/'.$row->image_mobile."' width='100'>";
                return $image_mobile;
            })
            ->addColumn('editUrl', function ($row) {
                return $row->id;
            })
            ->addColumn('deleteUrl', function ($row) {
                return $row->id;

            })
            ->make();
    }



    public function save(SlideshowFormRequest $request)
    {
        if (!auth()->user()->can($this->controller.'-create')){
            return view('errors.401');    
        }
        $title = $request->get('title');
        $subtitle = $request->get('subtitle');
        $button_text = $request->get('button_text');
        $url = $request->get('url');
        $target = $request->get('target');


        //saving table
        $data = new Slideshow;
        $data->title = $title;
        $data->subtitle = $subtitle;
        $data->button_text = $button_text;
        $data->url = $url;
        $data->target = $target;

        if($request->image){
            // upload logo bank
            $image = $request->image;
            $destinationPath = 'images/slideshow/';
            $filename = time().'.'.$request->image->extension();  
            $request->image->move($destinationPath, $filename);
            $data->image = $filename;

        }

        if($request->image_mobile){
            // upload logo bank
            $image_mobile = $request->image_mobile;
            $destinationPath = 'images/slideshow/';
            $filename = time().'.'.$request->image_mobile->extension();  
            $request->image_mobile->move($destinationPath, $filename);
            $data->image_mobile = $filename;

        }

        $data->status = 1;
        $data->created_by = Auth::user()->id;
        $data->save();
        echo json_encode(array("status" => TRUE));
    }

    public function get_data_byid(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }
        $id= $request->get('id');

        $datas = Slideshow::where('id',$id)->first();
        
        $data_return =array('data'=>$datas);
        return response()->json($data_return);
    }

    public function update(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        $title = $request->get('title');
        $subtitle = $request->get('subtitle');
        $button_text = $request->get('button_text');
        $url = $request->get('url');
        $target = $request->get('target');
    

        //update 
        $pk = Slideshow::find($id);
        $pk->title = $title;
        $pk->subtitle = $subtitle;
        $pk->button_text = $button_text;
        $pk->url = $url;
        $pk->target = $target;

        if($request->image){
            // upload logo bank
            $image = $request->image;
            $destinationPath = 'images/slideshow/';
            $filename = time().'.'.$request->image->extension();  
            $request->image->move($destinationPath, $filename);
            $pk->image = $filename;

        }

        if($request->image_mobile){
            // upload logo bank
            $image_mobile = $request->image_mobile;
            $destinationPath = 'images/slideshow/';
            $filename = time().'.'.$request->image_mobile->extension();  
            $request->image_mobile->move($destinationPath, $filename);
            $pk->image_mobile = $filename;

        }

        
        $pk->updated_by =Auth::user()->id;
        $pk->save();
        echo json_encode(array("status" => TRUE));

    }



    public function delete(Request $request){
        if (!auth()->user()->can($this->controller.'-delete')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        //update  
        $pk = Slideshow::find($id);
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
