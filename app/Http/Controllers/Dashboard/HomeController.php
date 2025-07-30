<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\RoleModel;
use Illuminate\Support\Facades\App;


class HomeController extends Controller
{

    private $controller = 'dashboard';
    private $title = 'Dashboard';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('adminauth');
    }

    
    public function index()
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $user = auth()->user();
        $user_param = array(
            'nama_user'=>$user->userDescription->nama_depan.'&nbsp;'.$user->userDescription->nama_belakang,
            'jabatan'=> $user->roles[0]['name'],
            'email'=> $user->email,
            'image'=>$user->images != '' ? asset('/images/users').'/'. $user->images : asset('/images/no-user.jpg'),
            'last_login'=>$user->last_login
        );

        return view('backend.'.$this->controller.'.home', compact('user','user_param'))->with(['controller'=>$this->controller, 'title'=>$this->title]);

        
    }

    






}
