<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Teams;
use App\Models\Membros;

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

    

    //ALTERAR LOGO
    public function alterarLogo(Request $request){
        
        $user = User::where('id', $request->id_user)->First();

        if(file_exists("/img/users/logo/$user->foto")){
            unlink("$user->foto");
            // $path = storage_path("/img/users/logo/$user->foto"); 
            // File::delete($path);//apaga foto antiga 
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


    //ALTERAR NOME
    public function alterarNick(Request $request){
        
        if (User::where('nick', $request->nick)->First()) {
            return back()->with('error', 'Ja existe um usuario com nick de ('.$request->nick.')');
        }

        if (Membros::where('nick', $request->nick)->First()) {
            return back()->with('error', 'Ja existe um membro com nick de ('.$request->nick.')');
        }

        //verify tamanho do nick
        if (strlen($request->nick) > 15) {
            return back()->with('error', "O nick que foi inserido estar muito grande!");
        }
        //verify tamanho do nick
        if (strlen($request->nick) < 2) {
            return back()->with('error', "O nick que foi inserido estar muito curto!");
        }

        $upd_nick = User::where('id', $request->id_user)
                        ->update([
                            'nick' => $request->nick
                        ]);
        if($upd_nick){
            return back()->with('success', 'O nick de usuario foi alterado com sucesso!');
        }else {
            return back()->with('error', 'Error ao alterar nick.');
        }

    }

    //ALTERAR LINK STEAM
    public function alterarLinksteam(Request $request){
        //verify uso de link steam
        if (User::where('link_steam', $request->linksteam)->First()) {
            return back()->with('error', 'O link da steam ja estar sendo usado por um usuario.');
        }
        //verify uso de link steam
        if (Membros::where('link_steam', $request->linksteam)->First()) {
            return back()->with('error', 'O link da steam ja estar sendo usado por um membro.');
        }

        if(empty($request->linksteam)){
            $newlink = 'null';
        }else{
            $newlink = $request->linksteam;
        }

        $upd_steam = User::where('id', $request->id_user)
                            ->update([
                                'link_steam' => $newlink
                            ]);
        if($upd_steam){
            return back()->with('success', 'link da steam foi alterado com sucesso!');
        }else {
            return back()->with('error', 'Error ao altera link da steam.');
        }
    }

     //ALTERAR LINK FACEIT
     public function alterarLinkfaceit(Request $request){
        //verify uso de link faceit
        if (User::where('link_faceit', $request->linkfaceit)->First()) {
            return back()->with('error', 'O link da faceit ja estar sendo usado por um usuario.');
        }
        //verify uso de link faceit
        if (Membros::where('link_faceit', $request->linkfaceit)->First()) {
            return back()->with('error', 'O link da faceit ja estar sendo usado por um membro.');
        }

        if(empty($request->linkfaceit)){
            $newlink = 'null';
        }else{
            $newlink = $request->linkfaceit;
        }
        $upd_faceit = User::where('id', $request->id_user)
                            ->update([
                                'link_faceit' => $newlink
                            ]);
        if($upd_faceit){
            return back()->with('success', 'link da faceit foi alterado com sucesso!');
        }else {
            return back()->with('error', 'Error ao altera link da faceit.');
        }
    }

    
    public function alterarSenha(Request $request){

        $user = User::where('id', $request->id_user)->First();

        //verify senha auth
        if (Hash::check($request->confnovasenha, $user->password))  {
            return back()->with('error', 'Senha inválida');
        }

        //verify confirmacao de senha
        if($request->senhanova != $request->confnovasenha){
            return back()->with('error', 'Senha de confirmação estar inválida');
        }

        //verify tamanho do senha
        if (strlen($request->senhanova) > 10) {
            return back()->with('error', "O nova senha que foi inserida estar muito grande!");
        }
        //verify tamanho do senha
        if (strlen($request->senhanova) < 2) {
            return back()->with('error', "O nova senha que foi inserida estar muito curta!");
        }

        $upd_senha = User::where('id', $request->id_user)
                    ->update([
                        'password' => Hash::make($request->senhanova)
                    ]);
        if($upd_senha){
            return back()->with('success', 'A sua senha foi alterada com sucesso!');
        }else {
            return back()->with('error', 'Error ao altera sua senha.');
        }
            
        
    }
    
}
