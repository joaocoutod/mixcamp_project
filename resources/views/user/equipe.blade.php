@extends('../layouts.main')

@section('title', 'Equipe | MIXCAMP')

@section('content')
<div class="container-fluid text-light text-center ">
    
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

    @if($exibir)
        <div class="text-center py-4">
            <a class="btn btn-warning  m-1" data-bs-toggle="modal" data-bs-target="#deletarTeam{{$team->id}}" href="#">Configuração de time </a>
            <a href="#" class="btn btn-outline-warning m-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                    <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                </svg>
            </a>
        </div>
    @endif


    <!-- SOBRE -->
    <div class="container" id="custom-cards">
        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4  justify-content-center">
        
            <div class="col">
                <div class="card card-cover  overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image:  linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('/img/tumblr/majorbr.jpeg'); background-position: center center; background-repeat:no-repeat; background-size:100% 100%;">
                    <div class="d-flex flex-column  p-5 pb-5 text-white text-shadow-1 text-center">
                        <h3 class="pt-3 mt-3 mb-3 display-6 fw-bold">Titulos</h3>
                        <p class=" display-6 fw-bold">{{$team->titulos}}</p>
                    </div>
                </div>
            </div>


        <div class="col">
            <div class="card card-cover overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.7)), url('/img/tumblr/team.png'); background-position: center center; background-repeat:no-repeat; background-size:100% 100%;">
                <div class="d-flex flex-column  p-5 pb-5 text-shadow-1  text-center">
                    <h3 class="pt-3 mt-3 mb-3 display-6  fw-bold ">Membros</h3>
                    <p class=" display-6 fw-bold">{{$team->qtd_membros}}</p>
                </div>
            </div>
        </div>

        </div>
    </div><!-- /SOBRE -->



    <!-- LISTA DE MEMBROS -->
    <div class="p-2">
        <div class="row g-3 justify-content-center">

            @if(count($membros) > 0)
            <div class="col-sm-8">
                <table class="table text-light my-5 table-hove ">
                    <thead>
                        <tr>
                            <th scope="col">Nick</th>
                            <th scope="col">Função</th>
                            <th scope="col">Steam</th>
                            <th scope="col">Faceit</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($membros as $membro)
                        @if($membro->id_equipe == $team->id)
                        <tr>
                            <th scope="row">{{$membro->nick}}</th>
                            <td>{{$membro->funcao}}</td>
                            <td class="p-2"><a href="{{$membro->link_steam}}" class="btn btn-primary" target="_blank">Steam</a></td>
                            <td class="p-2"><a href="{{$membro->link_faceit}}" class="btn btn-warning" target="_blank">Faceit</a></td>
                            <td class="p-1 text-center">

                                @if($exibir)
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
                                                <p>Confirme se deseja deletar o membro <b>{{$membro->nick}}</b></p>
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                                                    <a class="btn btn-danger" href="/equipe/membro/deletar/{{$membro->id}}/{{$team->id}}">Deletar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </td>

                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div><!-- div table -->
            @else

                <div class="text-center py-3">
                    <h1 class="text-center">Ainda não á membros</h1>
                </div>

            @endif

            @if($exibir)
            <div class="pb-5">
                <div class="justify-content-center">

                    <a href="#" class="btn btn-success  btn-lg mb-3" data-bs-toggle="modal" data-bs-target="#addMembro" class="btn btn-danger m-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Adicionar Membro
                    </a>

                </div><!-- justify-content-center -->
            </div><!-- /add membro -->
            @endif

        </div>  <!-- row -->
        
    </div>
</div><!-- MEMBROS -->


 <!-- MODAL EDITAR EQUIPE -->
 <div class="modal fade" id="deletarTeam{{$team->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-dark">
                <div class="row g-3">

                    <!-- PREVIEW FOTO -->
                    <div class="text-center">
                        <div class="">
                            <img id="output" width="200" height="200" class="rounded-circle py-2" >
                        </div>
                    </div>

                    <!-- FOTO -->
                    <form method="POST" action="/equipe/alterarlogo" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_equipe" value="{{$team->id}}">
                        <div class="col-sm-12">
                            <label for="logo">Logo equipe <span class="text-danger">*</span></label>
                            <input id="logo" type="file" accept="image/png, image/gif, image/jpeg" class="form-control" name="logo" onchange="loadfile(event)" autofocus required>
                        </div>
                        <button class="w-100 my-3 btn btn-lg btn-warning" type="submit">Alterar Foto</button>
                    </form>
                    
                    <!-- NOME -->
                    <form method="POST" action="/equipe/alterarnome">
                        @csrf
                        <input type="hidden" name="id_equipe" value="{{$team->id}}">
                        <div class="col-sm-12">
                            <label for="nome">Nome <span class="text-danger">*</span></label>
                            <input id="nome" class="form-control form-control-lg" name="nome" type="text" value="{{$team->nome}}" placeholder="nome da equipe" aria-label=".form-control-lg" autofocus required>
                        </div>
                        <button class="w-100 my-3 btn btn-lg btn-warning" type="submit">Alterar Nome</button>
                    </form>
                    
                    <!-- TAG -->
                    <form method="POST" action="/equipe/alterartag">
                        @csrf
                        <input type="hidden" name="id_equipe" value="{{$team->id}}">
                        <div class="col-sm-12">
                            <label for="tag">Tag <span class="text-danger">*</span></label>
                            <input id="tag" class="form-control form-control-lg" name="tag" type="text" value="{{$team->tag}}" placeholder="tag da equipe" aria-label=".form-control-lg" autofocus required>
                        </div>
                        <button class="w-100 my-3 btn btn-lg btn-warning" type="submit">Alterar Tag</button>
                    </form>

                </div>
            </div>
        </div>
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
                <form method="POST" action="/equipe/membro/create">
                    @csrf
                    
                    <input type="hidden" name="id_equipe" value="{{$team->id}}">
                    
                    <div class="col-sm-12 mb-3 ">
                        <label for="nick" class="text-left">Nick <span class="text-danger">*</span></label>
                        <input id="nick" type="text" class="form-control" name="nick" autofocus required>
                    </div>

                    <div class="col-sm-12 mb-3">
                        <label for="funcao">Função <span class="text-danger">*</span></label>
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



<!--PREVIEW DE IMAGEM-->
<script>
    //PREVIEW DE IMAGEM
    var loadfile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endsection