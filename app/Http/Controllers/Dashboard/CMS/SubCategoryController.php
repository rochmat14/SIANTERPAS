<?php

namespace App\Http\Controllers\Dashboard\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SubCategory;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Backend\SubCategoryRequest;
use Illuminate\Support\Facades\Auth;
class SubCategoryController extends Controller
{
    private $controller = 'sub_category';
    private $title = 'Data Sub Category';

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
        
        $rows = SubCategory::select([
            'id',
            'slug',
            'name_en',
            'name_id'
        ])
        ->where('status',1)
        // ->orderBy($arrColumns[$orderBy],$orderAD)
        ->orderBy('id','desc')
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
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

    public function save(SubCategoryRequest $request)
    {
        if (!auth()->user()->can($this->controller.'-create')){
            return view('errors.401');    
        }
        $name_en = $request->get('name_en');
        $name_id = $request->get('name_id');

        //saving table
        $data = new SubCategory;
        $data->slug = setUrlSlug(strtolower($request->get('name_en')));
        $data->name_en = $name_en;
        $data->name_id = $name_id;
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
        $datas = SubCategory::where('id',$id)->first();
        $data_return =array('data'=>$datas);
        return response()->json($data_return);
    }

    public function update(SubCategoryRequest $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        $name_en = $request->get('name_en');
        $name_id = $request->get('name_id');
        //update 
        $pk = SubCategory::find($id);
        $pk->slug = setUrlSlug(strtolower($request->get('name_en')));
        $pk->name_en = $name_en;
        $pk->name_id = $name_id;
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
        $pk = SubCategory::find($id);
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
