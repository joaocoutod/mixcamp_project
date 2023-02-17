<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teams;
use App\Models\Membros;

class MembroController extends Controller
{
    public function createMembro(Request $request){

        //verify tamanho do nick
        if (strlen($request->nick) > 15) {
            return back()->with('error', "O nick ($request->nick) excede o maximo de caracteres!");
        }
        //verify tamanho do nick
        if (strlen($request->nick) < 2) {
            return back()->with('error', "O nick ($request->nick) que foi inserido estar muito curto!");
        }

        //verify uso NICK
        if (Membros::where('nick', $request->nick)->First()) {
            return back()->with('error', 'O nick ('.$request->nick.') ja existe!');
        }
        
        //É permitido somente 1 na função de capitão e coach
        if($request->funcao == 'Capitão' || $request->funcao == 'Coach'){
            $verifyQtd = Membros::where('id_equipe', $request->id_equipe)
                                ->where('funcao', $request->funcao)
                                ->get();
            if(count($verifyQtd) > 0){
                return back()->with('error', "É permitido somente 1 na função de $request->funcao");
            }
        }

        //verify uso de link steam
        if (Membros::where('link_steam', $request->link_steam)->First()) {
            return back()->with('error', 'O link da steam ja estar sendo usado por outro usuario.');
        }

        //verify uso de link faceit
        if (Membros::where('link_faceit', $request->link_faceit)->First()) {
            return back()->with('error', 'O link da faceit ja estar sendo usado por outro usuario.');
        }

        //CRIAR EQUIPE    
        $team = new Membros;

        $team->id_equipe = $request->id_equipe;
        $team->nick = $request->nick;
        $team->funcao = $request->funcao;
        $team->link_steam = $request->link_steam;
        $team->link_faceit = $request->link_faceit;

        $team->save();

        $team = Teams::where('id', $request->id_equipe)->First();
        $add_qtd_membros = Teams::where('id', $request->id_equipe)
                                ->update([
                                    'qtd_membros' => $team->qtd_membros + 1
                                ]);

        if(Auth::check() == true){
            return redirect("/equipes/$request->id_equipe");
        }else{
            return redirect('/');
        }

    }


    public function deletarMembro($id_membro, $id_equipe){

        if(Auth::check() == false){
            return redirect('/login');
        }

        $membro = Membros::where('id', $id_membro)->First();

        $deleteMembro = Membros::where("id", $id_membro)
                                ->where("id_equipe", $id_equipe)
                                ->delete();

        $team = Teams::where('id', $id_equipe)->First();
        $add_qtd_membros = Teams::where('id', $id_equipe)
                                ->update([
                                    'qtd_membros' => $team->qtd_membros - 1
                                ]);

        if($deleteMembro){
            return back()->with('error', "O membro foi excluido");
        }else{
            return back()->with('error', "Error ao deletar membro");
        }
    }
}
