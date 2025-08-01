<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    private $controller = 'users_pengguna';
    private $direktory = 'signature';
    private $title = 'Signature';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($id)
    {
        $user = User::where('id', $id)->first();

        return view('backend.users_pengguna.'.$this->direktory.'.create', compact('user'))
            ->with(['controller' => $this->controller, 'title' => $this->title]);
    }

    public function tambahSignature(Request $request)
    {
        // $folderPath = public_path('images/signature/');
        $folderPath = 'images/signature/';
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.'.$image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
        $id = $request->id;
        $user = User::find($id);
        $user->signature = $fileName;
        $user->save();
        return redirect('/dashboard/users_pengguna');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('backend.users_pengguna.'.$this->direktory.'.edit', compact('user'))
            ->with(['controller' => $this->controller, 'title' => $this->title]);
    }

    public function ubahSignature(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        // $folderPath = public_path('images/signature/');
        $folderPath = 'images/signature/';
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.'.$image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
        $user->signature = $fileName;
        $user->save();
        return redirect('/dashboard/users_pengguna');
    }
}
