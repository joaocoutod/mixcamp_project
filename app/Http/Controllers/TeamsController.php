<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teams;
use App\Models\Membros;

class TeamsController extends Controller
{

    //VIEW FORM CRIAR EQUIPE
    public function viewForm(){

        if(Auth::check() == true){
            return view('/user/criarEquipe');
        }else{
            return redirect('/login');
        }

    }
    

    //VER EQUIPE POR ID
    public function equipeID($id){

        $team = Teams::where('id', $id)->first();
        $membros = Membros::all();

        $funcoes = [
            'Capitão',
            'Coach',
            'Awper',
            'Entry Fragger',
            'Baiter',
            'Suporte',
            'Lurker'
        ];

        if($team){
            return view('/perfil/equipes', ['team' => $team, 'membros' => $membros, 'funcoes' => $funcoes]);
        }else {
            return view('404');
        }
    }

    
    //CREATE EQUIPE
    public function createEquipe(Request $request){

         //verify NOME
         if (Teams::where('nome', $request->nome)->First()) {
            return back()->with('error', 'O nome da equipe ja existe!');
        }
        
        //verify NICK
        if (Teams::where('tag', $request->tag)->First()) {
            return back()->with('error', 'A tag da equipe ja existe!');
        }

        
        //CRIAR EQUIPE
        $requestLogo = $request->logo;
        $extension = $requestLogo->extension();
        $logoName = md5($requestLogo->getClientOriginalName().strtotime('now')).".".$extension;
        $requestLogo->move(public_path('img/teams/logo'), $logoName);

        
        $team = new Teams;

        $team->id_dono = Auth::user()->id;
        $team->logo = $logoName;
        $team->nome = $request->nome;
        $team->tag = $request->tag;
        $team->titulos = 0;
        $team->qtd_membros = 0;

        $team->save();

        if(Auth::check() == true){
            return redirect('/perfil/equipes');
        }else{
            return redirect('/');
        }

    }


    //ALTERAR EQUIPE
    public function alterarEquipe($id){

        //

   }

    //DELETE EQUIPE
    public function deleteEquipe($id){

        if(Auth::check() == false){
            return redirect('/login');
        }

        $team = Teams::where('id', $id)->First();
        $id_auth = Auth::user()->id;

        //verifica se equipe que sera deletada é do proprietario autenticado
        if($id_auth == $team->id_dono){

            //verifica se á membros reacionados a equipe
            $verifyMembros = Membros::where("id_equipe", $id)->get();

            if(count($verifyMembros) > 0){
                //deletar todos os membros relacionado a equipe que sera deletada
                $deleteMembros = Membros::where("id_equipe", $id)->delete();
            }

            //deletar equipe
            $deleteEquipe = Teams::where("id", $id)->delete();
            
            if($deleteEquipe){
                return back()->with('error', "A equipe $team->nome foi excluida");
            }else{
                return back()->with('error', "Error ao deletar $team->nome");
            }


        }else{
            return back()->with('error', "Voçé não é dono da equipe $team->nome para excluir");
        }
        

   }
}
