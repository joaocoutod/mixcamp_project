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

            return view('/user/minhasequipes', ['teams' => $teams]);

        }else{

            return redirect('/login');

        }
        
    }



    
}
