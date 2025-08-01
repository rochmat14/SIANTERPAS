<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use App\RoleModel;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Backend\UsersCreateRequest;
use App\Http\Requests\Backend\UsersUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\UserDescription;
use FontLib\Table\Type\name;

class UserController extends Controller
{
	private $controller = 'users_pengguna';
	private $role = 'users';
    private $title = 'Users Data';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        if (!$user->can($this->role.'-index')){
            return view('errors.401');    
        }


        $where = [];
        $orwhere = [];
        $roles = RoleModel::whereNotIn('name', ['SU','Account Manager'])->pluck('name', 'id')->toArray();


        return view('backend.'.$this->controller.'.index',compact('roles'))->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

    public function getData(Request $request)
    {
        $userLoged = auth()->user();
        if (!$userLoged->can($this->role.'-index')){
            return view('errors.401');    
        }
        
        $arrColumns = [1=>'id', 2=>'name', 3=>'email', 4=>'status'];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $where = [];
        // $whereGetRole = [];
        // if (!empty($userLoged->organization_id)){
        //     $where[] = ['organization_id', '=', $userLoged->organization_id];   
        //     $whereGetRole[] = ['organization_id', '=', $userLoged->organization_id];   
        //     $whereGetRole[] = ['employee_id', '=', $userLoged->employee_id];   
        // }
        $roles = RoleModel::where($where)->pluck('name', 'id')->toArray();  
        //return $roles;
        $rows = User::select([
            'id',
            'name',
            'email',
            'signature',
            'status'
        ])
        ->whereNotIn('id', [8,])
        ->whereHas('roles', function($query) use ($roles) {
            $query->whereNotIn('name', ['Account Manager']); // Sesuaikan dengan nama role yang Anda gunakan
        })
        ->where($where)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

      
        return Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {

            	if($row->status ==1){
		        	$get_status ='Active';
		        }else{
		        	$get_status =' Non Active';
		        }
                return $get_status;

            })
            ->addColumn('role', function ($row) {
                $roles = $row->getRoleNames()->toArray();
                return implode(', ', $roles);
            })
            
            ->addColumn('editUrl', function ($row) {
            	return $row->id;
                // return route($this->controller.'.edit', $row->id);
            })
            ->addColumn('showUrl', function ($row) {
                return route($this->controller.'.show', $row->id);
            })
            
            ->addColumn('activatedUrl', function ($row) {
            	// return $row->id;

                return route($this->controller.'.activated', $row->id);
            })
            ->addColumn('activatedText', function ($row) {
            	// return $row->id;

                return $row->status == 1 ? 'Non Aktifkan' : 'Aktifkan';
            })
            ->addColumn('activatedIcon', function ($row) {
                return $row->status == 1 ? 'close' : 'checked';
            })
            ->addColumn('fullname', function ($row) {
                return $row->userDescription['nama_depan'] . ' '. $row->userDescription['nama_belakang'];
            })
            ->make();
    }


    public function activated(Request $request, User $user)
    {
        
        $userLoged = auth()->user();
        if (!$userLoged->can($this->role.'-update')){
            return view('errors.401');    
        }

        $user->status    = ($user->status == 1 ? 2 : 1);
        $user->save();

        $notificationText = $user->status == 1 ? 'activated' : 'inactivated';

        return redirect()->route($this->controller.'.index')->with('status', __( 'main.data_has_been_'.$notificationText, ['page' => $user->name] ) );
    }



    public function save(UsersCreateRequest $request){
        $user = auth()->user();
        if (!$user->can($this->role.'-create')){
            return view('errors.401');    
        }

       

    	//data users desc
        $nama_depan = $request->get('nama_depan');
        $nama_belakang = $request->get('nama_belakang');
        $jenis_kelamin = $request->get('jenis_kelamin');
        $telp = $request->get('telp');
        $tempat_lahir = $request->get('tempat_lahir');
        $tanggal_lahir = $request->get('tanggal_lahir');
        $tanggal_masuk = $request->get('tanggal_masuk');
        $alamat_rumah = $request->get('alamat_rumah');

        //data users
        $name = $request->get('name');
        $email = $request->get('email');
        $role = $request->get('role');
        $password = $request->get('password');
        $password_confirmation = $request->get('password_confirmation');



        if($password == '') {
            $password = '123456789';
        } else {
            $password = $password;
        }

        

        $user = User::create([
            // 'name'      => $request->get('name'),
            'name'      => trim($nama_depan.$nama_belakang),
            //'username'  => $request->get('username'),
            'email'  => $request->get('email'),
            'password'  => Hash::make($password),
            'status'     => 1,
            'verified_status'     => 1
        ]);

        $user->syncRoles($request->role);
        $user->save();


        $data = new UserDescription;
        $data->users_id = $user->id;
        $data->nama_depan = $nama_depan;
        $data->nama_belakang = $nama_belakang;
        $data->jenis_kelamin = $jenis_kelamin;
        $data->phone = $telp;
        $data->tempat_lahir = $tempat_lahir;
        $data->tanggal_lahir = $tanggal_lahir;
        $data->tanggal_masuk = $tanggal_masuk;
        $data->alamat_rumah = $alamat_rumah;
        $data->status = 1;
        $data->created_by =Auth::user()->id;
        $data->save();
        echo json_encode(array("status" => TRUE));
    }


    public function get_data_byid(Request $request, $id){
    	// if (!auth()->user()->can($this->controller.'-update')){
        //     return view('errors.401');    
        // }
        $user = User::find($id);
        $roles = RoleModel::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name');
        

        $data_users_desc = UserDescription::where('users_id',$id)->first();

        $data_return =array('data'=>$user,'roles'=>$userRole,'data_users'=>$data_users_desc);

        return response()->json($data_return);

    }

    public function update(UsersUpdateRequest $request){
    	if (!auth()->user()->can($this->role.'-update')){
            return view('errors.401');    
        }
        

        //data users desc
        $id_users_desc = $request->get('id_users_desc');
        $nama_depan = $request->get('nama_depan');
        $nama_belakang = $request->get('nama_belakang');
        $jenis_kelamin = $request->get('jenis_kelamin');
        $telp = $request->get('telp');
        $tempat_lahir = $request->get('tempat_lahir');
        $tanggal_lahir = $request->get('tanggal_lahir');
        $tanggal_masuk = $request->get('tanggal_masuk');
        $alamat_rumah = $request->get('alamat_rumah');


        $password       = $request->get('password');
        $user = User::find($request->get('id'));
        $user->email =$request->get('email');
        if(!empty($password)){ 
            $user->password = Hash::make($password);
        }
        $user->updated_by =Auth::user()->id;
        $user->syncRoles($request->role);
        $user->save();


        //update data users desc area
        $data = UserDescription::find($id_users_desc);
        $data->nama_depan = $nama_depan;
        $data->nama_belakang = $nama_belakang;
        $data->jenis_kelamin = $jenis_kelamin;
        $data->phone = $telp;
        $data->tempat_lahir = $tempat_lahir;
        $data->tanggal_lahir = $tanggal_lahir;
        $data->tanggal_masuk = $tanggal_masuk;
        $data->alamat_rumah = $alamat_rumah;
        $data->updated_by =Auth::user()->id;
        $data->save();

        echo json_encode(array("status" => TRUE));
    }

    public function show(Request $request, $id){
        if (!auth()->user()->can($this->role.'-show')){
            return view('errors.401');    
        }

        $id_users_desc = $request->id;


        

        $users_desc = UserDescription::select('ms_users_description.*')
                    // ->where('ms_users_description.id',$id_users_desc)
                    ->where('ms_users_description.users_id',$id)
                    ->first();
        $user = User::where('id',$id)->first();
        // $user = User::where('id',$users_desc->users_id)->first();

        $roles = RoleModel::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->first();

        return view('backend.'.$this->controller.'.show',compact('user','userRole','users_desc'))->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

    public function getOptionData()
    {
        $users = User::where('status', 1)->get();

        foreach($users as $value) {
            $arrayUsers[] = array(
                'id'   => $value->id,
                'name' => $value->name,
                'nama_depan' => $value->userDescription['nama_depan'],
                'nama_belakang' => $value->userDescription['nama_belakang'],
                'role' => $value->roles->pluck('name')
            );
        }
        
        return json_encode($arrayUsers);
    }
}
