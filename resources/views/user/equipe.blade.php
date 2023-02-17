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
        <div class="text-center">
            <a class="btn btn-warning  m-1" data-bs-toggle="modal" data-bs-target="#deletarTeam{{$team->id}}" href="#">Configuração de time </a>
            <a href="#" class="btn btn-outline-warning m-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                    <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                </svg>
            </a>
        </div>
    @endif


    <!-- SOBRE -->
    <div class="container p-4" id="custom-cards">
        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4  justify-content-center">
        
            <div class="col">
                <div class="card card-cover  overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image:  linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('/img/tumblr/majorbr.jpeg'); background-position: center center; background-repeat:no-repeat; background-size:100% 100%;">
                    <div class="d-flex flex-column  p-5 pb-5 text-white text-shadow-1 text-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-trophy mt-3 " viewBox="0 0 16 16">
                            <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935zM3.504 1c.007.517.026 1.006.056 1.469.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.501.501 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667.03-.463.049-.952.056-1.469H3.504z"/>
                        </svg>
                        <p class="pt-3 mb-3 fs-4 fw-bold">Titulos</p>
                        <p class=" display-6 fw-bold">{{$team->titulos}}</p>
                    </div>
                </div>
            </div>


        <div class="col">
            <div class="card card-cover overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.7)), url('/img/tumblr/team.png'); background-position: center center; background-repeat:no-repeat; background-size:100% 100%;">
                <div class="d-flex flex-column  p-5 pb-5 text-white text-shadow-1 text-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-people mt-3" viewBox="0 0 16 16">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                    </svg>
                    <h3 class="pt-3  mb-3  fs-4 fw-bold ">Membros</h3>
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
                            <td class="p-2"><a href="{{$membro->link_steam}}" class="btn btn-primary" target="_blank"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Steam</a></td>
                            <td class="p-2"><a href="{{$membro->link_faceit}}" class="btn btn-warning" target="_blank"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Faceit</a></td>
                            <td class="p-1 text-center">

                                @if($exibir)
                                <div class="text-center">
                                    <a data-bs-toggle="modal" data-bs-target="#deletarMembro{{$membro->id}}" class="btn btn-danger m-1" href="#"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">deletar</a>
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