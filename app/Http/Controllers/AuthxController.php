<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Membros;

class AuthxController extends Controller
{
    //VIEW LOGIN
    public function indexLogin(){ return view('/auth/login'); }

    //VIEW CADASTRO
    public function indexCadastro(){ return view('/auth/cadastro'); }


    //-------------LOGIN---------------/
    public function authLogin(Request $request){

        $user = User::where('nick', $request->nick)->First();
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

            //VERIFY NICK
            if (User::where('nick', $request->nick)->First()) {
                return back()->with('error', 'O nick ('.$request->nick.') ja existe!');
            }
            
            //VALIDA SENHA
            if ($request->password != $request->password_confirmation) {    
                return back()->with('error', 'Confirmação de senha não confere');
            }

            //verify uso de link steam
            if (Membros::where('link_steam', $request->link_steam)->First()) {
                return back()->with('error', 'O link da steam ja estar sendo usado por um membro.');
            }

            //verify uso de link steam
            if (User::where('link_steam', $request->link_steam)->First()) {
                return back()->with('error', 'O link da steam ja estar sendo usado por um usuario.');
            }


            
            //CRIAR USER
            $user = new User;
            $user->nick = $request->nick; 
            $user->password = Hash::make($request->password);
            $user->foto = 'logo.png'; 
            $user->link_steam = $request->link_steam;
            $user->link_faceit = 'null';
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
