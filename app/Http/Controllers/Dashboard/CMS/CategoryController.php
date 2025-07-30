<?php

namespace App\Http\Controllers\Dashboard\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Backend\CategoryRequest;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    private $controller = 'category';
    private $title = 'Data Category';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }

        return view('backend.'.$this->controller.'.index')->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }


    public function getData(Request $request)
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $arrColumns = [1=>'id', 2=>'slug',3=>'name'];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = Category::select([
            'id',
            'slug',
            'main',
            'name'
        ])
        ->where('status',1)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()

            ->addColumn('main', function ($row) {
                $main = $row->main;
                $rest="";
                if($main == 1){
                    $rest .="<a href='javascript:void(0)' class='badge bg-light mt-2' onclick=setup_unmain(".$row->id.") title='Un Main'>
                                <i class='fa fa-cog text-success'></i> Main
                            </a>&nbsp;";
                }else{
                    $rest .="<a href='javascript:void(0)' class='badge bg-light mt-2' onclick=setup_main(".$row->id.") title='Setup Main'>
                                <i class='fa fa-cog text-warning'></i> Un Main
                            </a>&nbsp;";
                }
                
                return $rest;
            })
            
            ->addColumn('action', function ($row) {
                $rest ="";
                if (auth()->user()->can($this->controller.'-update')){
                        $rest .="<a href='javascript:void(0)' class='badge bg-light mt-2' onclick=edited(".$row->id.") title='Edit'>
                                <i class='fa fa-edit text-info'></i> Edit
                            </a>&nbsp;";
                    
                }
                if (auth()->user()->can($this->controller.'-delete')){
                    $main = $row->main;
                    if($main != 1){
                        $rest .="<a href='javascript:void(0)' class='badge bg-light mt-2' onclick=removed(".$row->id.") title='removed'>
                                <i class='fa fa-remove text-danger'></i> Delete
                            </a>";
                    }
                }
                
                return $rest;
            })
            ->escapeColumns('main')
            ->make();
    }

    public function save(CategoryRequest $request)
    {
        if (!auth()->user()->can($this->controller.'-create')){
            return view('errors.401');    
        }


        $name = $request->get('name');


        //saving table
        $data = new Category;
        $data->slug = setUrlSlug(strtolower($request->get('name')));
        $data->name = $name;
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

        $datas = Category::where('id',$id)->first();
        
        $data_return =array('data'=>$datas);
        return response()->json($data_return);
    }

    public function update(CategoryRequest $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        $name = $request->get('name');
    

        //update 
        $pk = Category::find($id);
        $pk->slug = setUrlSlug(strtolower($request->get('name')));
        $pk->name = $name;
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
        $pk = Category::find($id);
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


    public function setup_main(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        $data_main = $request->get('data_main');
        //update  
        $pk = Category::find($id);
        $pk->main = $data_main;
        $pk->updated_by =Auth::user()->id;
        $pk->save();
        $result=array(
                "data_post"=>array(
                    "status"=>TRUE,
                    "class" => "success",
                    "message"=>"Success ! Update data"
                )
            );
        echo json_encode($result);
    }
}
