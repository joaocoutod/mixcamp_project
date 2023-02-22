<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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

        //VERIFICA SE EXISTE O TIME
        $team = Teams::where('id', $id)->First();
        
        if($team){
            //BUSCA MEMBROS DA EQUIPE
            $membros = Membros::where('id_equipe', $id)
                    ->orderByRaw("CASE WHEN funcao='Membro' THEN 1 ELSE 0 END")
                    ->orderByRaw("CASE WHEN funcao='Reserva' THEN 1 ELSE 0 END")
                    ->orderByRaw("CASE WHEN funcao='Coach' THEN 0 ELSE 1 END")
                    ->orderByRaw("CASE WHEN funcao='Capitão' THEN 0 ELSE 1 END")
                    ->get();



            //FUNCOES DE PLAYER
            $funcoes = [
                'Capitão',
                'Coach',
                'Awper',
                'Entry Fragger',
                'Suporte',
                'Lurker',
                'Membro',
                'Reserva'
            ];


            //VERIFICA SE JA EXISTE CAPITAO NA EQUIPE
            $qtdCapitao = Membros::where('id_equipe', $id)->where('funcao', 'Capitão')->get();
            $exibirCapitao = count($qtdCapitao) > 0 ? false : true; //SE JA EXISTIR CAPITAO NAO EXIBE A FUNCAO


            //VERIFICA SE JA EXISTE COACH NA EQUIPE
            $qtdCoach = Membros::where('id_equipe', $id)->where('funcao', 'Coach')->get();
            $exibirCoach = count($qtdCoach) > 0 ? false : true;//SE JA EXISTIR COACH NAO EXIBE A FUNCAO

            //LIMITE DE MEMBROS TITULARES = 5 (capitao, player1, player2, player3, player4)
            $titulares = Membros::where('id_equipe', $id)->whereNotIn('funcao', ['Coach', 'Reserva', 'Membro'])->get();
            $exibirTitulares = count($titulares) > 4 ? false : true;

            //LIMITE DE RESERVAS
            $reservas = Membros::where('id_equipe', $id)->where('funcao', 'Reserva')->get();
            $exibirReservas = count($reservas) > 2 ? false : true;


            //VERIFICA SE TODOS AS FUNCOES NAO É PRA EXIBIR
            $reservas = Membros::where('id_equipe', $id)->get();
            $exibirFuncoes = count($reservas) > 13 ? false : true;
            
            //VALIDA EXIBIÇÃO DE ALGUNS COMPONENTES
            $exibir = false;
            if(Auth::check() == true){
                if(Auth::user()->id == $team->id_dono){
                    $exibir = true;
                }
            }

            


            return view('/user/equipe', [
                'team' => $team,
                'membros' => $membros, 
                'funcoes' => $funcoes, 
                'exibir' => $exibir,
                'exibirCapitao' => $exibirCapitao,
                'exibirCoach' => $exibirCoach,
                'exibirTitulares' => $exibirTitulares,
                'exibirReservas' => $exibirReservas,
                'exibirFuncoes' => $exibirFuncoes
            ]);


        }else {
            return view('404');
        }
    }

    
    //CREATE EQUIPE
    public function createEquipe(Request $request){

        //verify tamanho do nick
        if (strlen($request->nome) > 15) {
            return back()->with('error', "O nome que foi inserido estar muito grande!");
        }
        //verify tamanho do nick
        if (strlen($request->nome) < 2) {
            return back()->with('error', "O nome que foi inserido estar muito curto!");
        }

         //verify NOME
         if (Teams::where('nome', $request->nome)->First()) {
            return back()->with('error', 'O nome da equipe ja existe!');
        }


        //verify tamanho do tag
        if (strlen($request->tag) > 15) {
            return back()->with('error', "A tag da equipe que foi inserido excede o maximo de caracteres!");
        }
        //verify tamanho do tag
        if (strlen($request->tag) < 2) {
            return back()->with('error', "A tag da equipe que foi inserido é curto!");
        }
        //verify TAG
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

    //LOGO
    public function alterarLogo(Request $request){
        
        $equipe = Teams::where('id', $request->id_equipe)->First();
        $path = storage_path("/img/teams/logo/$equipe->logo"); 
        File::delete($path);//apaga logo antiga 

        $requestLogo = $request->logo;
        $extension = $requestLogo->extension();
        $logoName = md5($requestLogo->getClientOriginalName().strtotime('now')).".".$extension;
        $requestLogo->move(public_path('img/teams/logo'), $logoName);//salva logo nova 

        $upd_logo = Teams::where('id', $request->id_equipe)
                        ->update([
                            'logo' => $logoName
                        ]);

        if($upd_logo){
            return back()->with('success', 'A logo foi alterada com sucesso!');
        }else {
            return back()->with('error', 'Error ao alterar logo.');
        }
    }

    //NOME
    public function alterarNome(Request $request){
        
        if (Teams::where('nome', $request->nome)->First()) {
            return back()->with('error', 'O nome de equipe ('.$request->nome.') ja existe!');
        }

         //verify tamanho do nome
         if (strlen($request->nome) > 15) {
            return back()->with('error', "O nome que foi inserido estar muito grande!");
        }
        //verify tamanho do nome
        if (strlen($request->nome) < 2) {
            return back()->with('error', "O nome que foi inserido estar muito curto!");
        }

        $upd_nome = Teams::where('id', $request->id_equipe)
                        ->update([
                            'nome' => $request->nome
                        ]);
        if($upd_nome){
            return back()->with('success', 'O nome da equipe foi alterado com sucesso!');
        }else {
            return back()->with('error', 'Error ao alterar nome.');
        }

    }

    //TAG
    public function alterarTag(Request $request){
        
        if (Teams::where('nome', $request->tag)->First()) {
            return back()->with('error', 'A tag de equipe ('.$request->tag.') ja existe!');
        }

        $upd_tag = Teams::where('id', $request->id_equipe)
                        ->update([
                            'tag' => $request->tag
                        ]);
        if($upd_tag){
            return back()->with('success', 'A tag da equipe foi alterado com sucesso!');
        }else {
            return back()->with('error', 'Error ao alterar tag.');
        }
    
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
