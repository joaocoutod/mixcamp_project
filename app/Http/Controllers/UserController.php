<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
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
    

    //LOGO
    public function alterarLogo(Request $request){
        
        $user = User::where('id', $request->id_user)->First();

        if(file_exists("/img/users/logo/$user->foto")){
            $path = storage_path("/img/users/logo/$equipe->logo"); 
            File::delete($path);//apaga foto antiga 
        }

        $requestFoto = $request->foto;
        $extension = $requestFoto->extension();
        $fotoName = md5($requestFoto->getClientOriginalName().strtotime('now')).".".$extension;
        $requestFoto->move(public_path('img/users/logo/'), $fotoName);//salva foto nova 

        $upd_foto = User::where('id', $request->id_user)
                        ->update([
                            'foto' => $fotoName
                        ]);

        if($upd_foto){
            return back()->with('success', 'A foto foi alterada com sucesso!');
        }else {
            return back()->with('error', 'Error ao alterar foto.');
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
