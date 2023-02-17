<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Teams;

class UserController extends Controller
{

    //VIEW PERFIL
    public function indexPerfil($id){

        $user = User::where('id', $id)->first();

        if($user){
            return view('/user/perfil', ['user' => $user]);
        }else {
            return view('404');
        }
        
    
    }
    
    
    //MINHAS EQUIPES
    public function minhasequipes(){
        
        if(Auth::check() == true){

            $id_dono = Auth::user()->id;
            $teams = Teams::where('id_dono', $id_dono)->get();

            //LIMITE DE EQUIPES QUE UM USUARIO PODE CRIAR = 2
            $equipes = Teams::where('id_dono', Auth::user()->id)->get();
            $criarEquipe = count($equipes) > 1 ? false : true; 

            return view('/user/minhasequipes', ['teams' => $teams, 'criarEquipe' => $criarEquipe]);

        }else{

            return redirect('/login');

        }
        
    }



    
}
