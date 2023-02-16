@extends('../layouts.main')

@section('title', 'Equipe | MIXCAMP')

@section('content')
<div class="container-fluid text-light text-center ">
    
    <div class="profile pt-5">
         @if(session('success'))
            <div class="container alert alert-success text-center" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="container alert alert-danger text-center" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <img src="/img/teams/logo/{{$team->logo}}" width="200" height="200" class="rounded-circle py-2">

        <h2>{{ $team->nome }}</h2>

        <div class="p-2">
            <div class="row g-3 justify-content-center">

                <div class="col-sm-6">
                    <a href="#" class="btn btn-warning">Configuração de time </a>
                    <a href="#" class="btn btn-outline-warning m-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                            <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                        </svg>
                    </a>
                </div>

            


                <div class="col-sm-8">
                    <table class="table text-light my-5 table-hove ">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Função</th>
                                <th scope="col">Link steam</th>
                                <th scope="col">Link faceit</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($membros as $membro)
                            @if($membro->id_equipe == $team->id)
                            <tr>
                                <th scope="row">{{$membro->nome}}</th>
                                <td>{{$membro->funcao}}</td>
                                <td class="p-2"><a href="{{$membro->link_steam}}" class="btn btn-primary">Steam</a></td>
                                <td class="p-2"><a href="{{$membro->link_faceit}}" class="btn btn-warning">Faceit</a></td>
                                <td class="p-1 text-center">
                                    <div class="text-center">
                                        <a data-bs-toggle="modal" data-bs-target="#deletarMembro{{$membro->id}}" class="btn btn-danger m-1" href="#">deletar</a>
                                    </div>
                                    
                                    <!-- MODAL DELETAR Team -->
                                    <div class="modal fade" id="deletarMembro{{$membro->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    <p>Confirme se deseja deletar a equipe <b>{{$membro->nome}}</b></p>
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                                                        <a class="btn btn-danger" href="/equipes/membro/deletar/{{$membro->id}}/{{$team->id}}">Deletar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    </div>
        
            </div>  
        </div>


        <div class="py-4">
            <div class="row g-3 justify-content-center">

                <div class="col-sm-3">

                    @if(Auth::user()->id == $team->id_dono)
                    <a href="#" class="btn btn-success w-100 btn-lg mb-3" data-bs-toggle="modal" data-bs-target="#addMembro" class="btn btn-danger m-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Adicionar Membro
                    </a>
                    @endif

                </div><!-- col-3 -->

            </div> <!-- row -->
        </div><!-- social midia-->
        
    </div>
</div>


<!-- MODAL MEMBRO -->
<div class="modal fade" id="addMembro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-dark">
                <h1 class="text-center">Adicionar Membro</h1>
                <form method="POST" action="/equipes/membro/create">
                    @csrf
                    
                    <input type="hidden" name="id_equipe" value="{{$team->id}}">
                    
                    <div class="col-sm-12 mb-3 ">
                        <label for="nome" class="text-left">Nick <span class="text-danger">*</span></label>
                        <input id="nome" type="text" class="form-control" name="nome" autofocus required>
                    </div>

                    <div class="col-sm-12 mb-3">
                        <label for="nick">Função <span class="text-danger">*</span></label>
                        <select name="funcao" id="funcao" class="form-control " autofocus required>
                            @for($i = 0; $i < count($funcoes); $i++)
                            <option value="{{$funcoes[$i]}}">{{$funcoes[$i]}}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-sm-12 mb-3 ">
                        <label for="link_steam" class="text-left">Link steam <span class="text-danger">*</span></label>
                        <input id="link_steam" type="text" class="form-control" name="link_steam" autofocus required type="url" placeholder="https://steamcommunity.com/id/exemple"  pattern="https://steamcommunity.com.*" aria-label=".form-control-lg" autofocus required>
                    </div>

                    <div class="col-sm-12 mb-3 ">
                        <label for="link_faceit" class="text-left">Link Faceit <span class="text-danger">*</span></label>
                        <input id="link_faceit" type="text" class="form-control" name="link_faceit" autofocus required type="url" placeholder="https://www.faceit.com/pt-br/players/exemple"  pattern="https://www.faceit.com/.*" aria-label=".form-control-lg" autofocus required>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Inserir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection