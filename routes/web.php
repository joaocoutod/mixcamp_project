<?php

use Illuminate\Support\Facades\Route;

use App\http\Controllers\HomeController;
use App\http\Controllers\AuthxController;
use App\http\Controllers\UserController;
use App\http\Controllers\TeamsController;
use App\http\Controllers\MembroController;



//ROUTES PADRAO
Route::get('/', [HomeController::class, 'indexHome']);



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

//VER MINHAS EQUIPES
Route::get('perfil/equipes', [UserController::class, 'minhasEquipes']);






/********EQUIPES********/

//CRIAR EQUIPE
Route::get('/criarequipe', [TeamsController::class, 'viewForm']);
Route::post('/equipe/create', [TeamsController::class, 'createEquipe']);

//VER EQUIPE POR {ID}
Route::get('/equipe/{id}', [TeamsController::class, 'equipeID']);


//DELETAR EQUIPE
Route::get('/equipes/deletar/{id}', [TeamsController::class, 'deleteEquipe']);






/********MEMBROS********/

//CRIAR MEMBROS
Route::post('/equipes/membro/create', [MembroController::class, 'createMembro']);

//EXCLUIR MEMBRO
Route::get('/equipes/membro/deletar/{id_membro}/{id_equipe}', [MembroController::class, 'deletarMembro']);