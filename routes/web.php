<?php

use Illuminate\Support\Facades\Route;

use App\http\Controllers\HomeController;
use App\http\Controllers\AuthxController;
use App\http\Controllers\UserController;
use App\http\Controllers\TeamsController;
use App\http\Controllers\MembroController;



//ROUTES PADRAO
Route::get('/', [HomeController::class, 'indexHome']);
Route::get('/equipes', [TeamsController::class, 'indexTimes']);
Route::get('/busca/equipes', [TeamsController::class, 'buscaEquipes']);



/********AUTENTICAÇÃO********/
//LOGIN
Route::get('/login', [AuthxController::class, 'indexLogin']);
Route::post('/auth/login', [AuthxController::class, 'authLogin']);

//CADASTRO
Route::get('/cadastro', [AuthxController::class, 'indexCadastro']);
Route::post('/auth/cadastro', [AuthxController::class, 'authCadastro']);

//SAIR
Route::get('/logout', [AuthxController::class, 'logout']);





/********USER PERFIL********/
Route::get('/user/{id}', [UserController::class, 'indexPerfil']);

//EDITAR USERS
Route::post('/user/alterar/alterarlogo', [UserController::class, 'alterarLogo']);
Route::post('/user/alterar/alterarnick', [UserController::class, 'alterarNick']);
Route::post('/user/alterar/alterarlinksteam', [UserController::class, 'alterarlinkSteam']);
Route::post('/user/alterar/alterarlinkfaceit', [UserController::class, 'alterarlinkFaceit']);
Route::post('/user/alterar/alterarsenha', [UserController::class, 'alterarSenha']);

//VER MINHAS EQUIPES
Route::get('perfil/equipes', [UserController::class, 'minhasEquipes']);






/********EQUIPES********/

//CRIAR EQUIPE
Route::get('/criarequipe', [TeamsController::class, 'viewForm']);
Route::post('/equipe/create', [TeamsController::class, 'createEquipe']);


//VER EQUIPE POR {ID}
Route::get('/equipes/{id}', [TeamsController::class, 'equipeID']);


//DELETAR EQUIPE
Route::get('/equipe/deletar/{id}', [TeamsController::class, 'deleteEquipe']);

//EDITAR EQUIPES
Route::post('/equipe/alterarlogo', [TeamsController::class, 'alterarLogo']);
Route::post('/equipe/alterarnome', [TeamsController::class, 'alterarNome']);
Route::post('/equipe/alterartag', [TeamsController::class, 'alterarTag']);



/********MEMBROS********/

//CRIAR MEMBROS
Route::post('/equipe/membro/create', [MembroController::class, 'createMembro']);

//EDITAR EQUIPES
Route::post('/equipe/membro/alterarnick', [MembroController::class, 'alterarNick']);
Route::post('/equipe/membro/alterarfuncao', [MembroController::class, 'alterarFuncao']);
Route::post('/equipe/membro/alterarlinksteam', [MembroController::class, 'alterarLinksteam']);
Route::post('/equipe/membro/alterarlinkfaceit', [MembroController::class, 'alterarLinkfaceit']);

//EXCLUIR MEMBRO
Route::get('/equipe/membro/deletar/{id_membro}/{id_equipe}', [MembroController::class, 'deletarMembro']);