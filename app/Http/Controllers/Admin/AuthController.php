<?php

namespace Imobinit\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Imobinit\Http\Controllers\Controller;
use Imobinit\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if(Auth::check() === true ){
            return redirect()->route('admin.home');
        }
        return view('admin.index');
    }

    public function home()
    {
        return view('admin.dashboard');
    }

    public function login(Request $req)
    {
        if(in_array('', $req->only('email', 'password'))){
            $json['message'] = $this->message->error('Informe todos os dados para efetuar o login')->render();

            return response()->json($json);
        }

        if(!filter_var($req->email, FILTER_VALIDATE_EMAIL)){
            $json['message'] = $this->message->error('Por favor, informe um e-mail válido')->render();

            return response()->json($json);
        }

        $credentials = [
            'email'    => $req->email,
            'password' => $req->password
        ];

        if(!Auth::attempt($credentials)){
            $json['message'] = $this->message->error('Ooops, usuário e senha não conferem')->render();

            return response()->json($json);
        }

        $this->authenticate($req->getClientIp());
        $json['redirect'] = route('admin.home');

        return $json;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    private function authenticate(string $ip)
    {
        $user = User::where('id', Auth::user()->id);

        $user->update([
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $ip
        ]);

    }
}
