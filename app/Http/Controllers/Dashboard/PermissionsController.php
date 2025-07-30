<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;


use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Backend\PermissionsRequest;
use Illuminate\Support\Facades\Auth;



class PermissionsController extends Controller
{
    private $controller = 'permissions';
    private $title = 'Permission';

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
        
        $arrColumns = [1=>'id', 2=>'name'];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = Permission::select([
            'id',
            'name'
        ])
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('editUrl', function ($row) {
                return $row->id;
                // return route($this->controller.'.edit', $row->id);
            })
            ->addColumn('deleteUrl', function ($row) {
                return $row->id;

                // return route($this->controller.'.destroy', $row->id);
            })
            ->make();
    }


    public function save(PermissionsRequest $request)
    {
        if (!auth()->user()->can($this->controller.'-create')){
            return view('errors.401');    
        }


        $name = $request->get('name');


        //saving table
        $data = new Permission;
        $data->name = $name;
        $data->guard_name ='web';
        $data->created_by = Auth::user()->id;
        $data->save();
        echo json_encode(array("status" => TRUE));
    }

    public function get_data_byid(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }
        $id= $request->get('id');

        $datas = Permission::where('id',$id)->first();
        
        $data_return =array('data'=>$datas);
        return response()->json($data_return);
    }

    public function update(PermissionsRequest $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        $name = $request->get('name');
    

        //update 
        $pk = Permission::find($id);
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
        $pk = Permission::find($id);
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
