<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Campeonato;

class CampeonatoController extends Controller
{
     //PAGINA PARA VER CAMPEONATOS
     public function indexCampeonatos(){
        $campeonatos = Teams::all();

        return view('/campeonatos', ['campeonatos' => $campeonatos]); 
    }

    public function buscaCampeonatos(Request $request){ 
        // Obtém o valor da pesquisa do parâmetro "query"
        $query = $request->input('query');

        // Realiza a busca no banco de dados e retorna os resultados
        $results = Campeonatos::where('titulo', 'like', '%' . $query . '%')->get();

        // Retorna os resultados em formato JSON
        return response()->json($results);
    }

}
