<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthxController extends Controller
{
    //VIEW LOGIN
    public function indexLogin(){ return view('/auth/login'); }

    //VIEW CADASTRO
    public function indexCadastro(){ return view('/auth/cadastro'); }


    //-------------LOGIN---------------/
    public function authLogin(Request $request){

        //VALIDA EMAIL
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return back()->with('error', 'O email estar invalido!');
        }


        $user = User::where('email', $request->email)->first();
        if ($user) {

            if (Hash::check($request->password, $user->password))  {//valida senha
                Auth::login($user); // autentica o usuário
                return redirect('/user/'.Auth::user()->id);
            }
            
            return back()->with('error', 'Senha invalida');
            
        }

        return back()->with('error', 'Crendencias invalidas');
    }


    //-------------CADASTRO---------------/
    public function authCadastro(Request $request){
        if(!empty($request)){

            //VERIFY EMAIL
            if (User::where('email', $request->email)->First()) {
                return back()->with('error', 'O email ja existe!');
            }
            
            //VERIFY NICK
            if (User::where('nick', $request->nick)->First()) {
                return back()->with('error', 'O nick ('.$request->nick.') ja existe!');
            }
            
            //VALIDA SENHA
            if ($request->password != $request->password_confirmation) {    
                return back()->with('error', 'Confirmação de senha não confere');
            }

            
            //CRIAR USER
            $user = new User;

            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->nick = $request->nick;   
            $user->link_steam = $request->link_steam;
            $user->link_gamesclub = 'x';
            $user->team = 0;

            $user->save();

            Auth::login($user);

            return  redirect('/user/'.Auth::user()->id);

        }else{

            return back()->with('error', 'Error ao fazer cadastro');

        }
        
    }


    //-------------SAIR---------------/
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
