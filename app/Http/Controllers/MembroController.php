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

        //verify NOME
        if (Membros::where('nome', $request->nome)->First()) {
            return back()->with('error', 'O nome do membro ja existe!');
        }

        //CRIAR EQUIPE    
        $team = new Membros;

        $team->id_equipe = $request->id_equipe;
        $team->nome = $request->nome;
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
            return redirect("/equipe/$request->id_equipe");
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
