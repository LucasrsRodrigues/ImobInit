<?php

namespace Imobinit\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Imobinit\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.index');
    }

    public function home()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if(in_array('', $request->only('email', 'password'))){
            $json['message'] = "Informe todos os dados";
            return response()->json($json);
        }
    }

}
