@extends('../layouts.main')

@section('title', 'Minhas Equipes | MIXCAMP')

@section('content')

<div class="container text-light my-5">

    <div class="row justify-content-center ">

        <div class="col-sm-10">

            @if(count($teams) > 0)
            <h1 class="text-center">Minhas equipes</h1>
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
            <table class="table text-light my-5 table-hove ">
                <thead>
                    <tr>
                        <th scope="col">Time</th>
                        <th scope="col">Tag</th>
                        <th scope="col">Membros</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $team)
                    <tr>
                        <th scope="row" class="p-3">
                            <!--<img src="/img/teams/logo/{{$team->logo}}" width="50" height="50" class="rounded-circle">-->
                            {{$team->nome}}
                        </th>
                        <td class="p-3">{{$team->tag}}</td>
                        <td class="p-3">{{$team->qtd_membros}}</td>
                        <td class=" text-center">
                            <div class="text-center">
                                <a href="/equipes/{{$team->id}}" class="btn btn-success m-1"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Ver</a>
                            </div>
                        </td>
                        <td class=" text-center">
                            <div class="text-center">
                                <a data-bs-toggle="modal" data-bs-target="#deletarTeam{{$team->id}}" class="btn btn-danger m-1" href="#"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">deletar</a>
                            </div>
                        </td>
                            
                            <!-- MODAL DELETAR Team -->
                            <div class="modal fade" id="deletarTeam{{$team->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-dark">
                                            <p>Confirme se deseja deletar a equipe <b>{{$team->nome}}</b></p>
                                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                                                <a class="btn btn-danger" href="/equipe/deletar/{{$team->id}}">Deletar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($criarEquipe != false)
            <div class="text-center">
                <a class="btn btn-outline-warning p-3" data-bs-toggle="modal" data-bs-target="#criarEquipe">Criar Equipe</a>
            </div>
            @else
            <div class="text-center ">
                <p class="p-3 fs-3">Pode criar até 2 equipes</p>
            </div>
            @endif

            @else

                <div class="text-center py-5 my-5">
                    <h1 class="text-center">Ainda não tem equipes</h1>
                    <a class="btn btn-outline-warning p-3" data-bs-toggle="modal" data-bs-target="#criarEquipe">Criar Equipe</a>
                </div>
                

            @endif
        </div>

        
        
    </div>
</div>



<!-- MODAL CRIAR MEMBRO -->
<div class="modal fade" id="criarEquipe" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-dark ">
                <h1 class="text-center">Adicionar Equipe</h1>
                <div class="text-center">
                    <img id="output" width="200" height="200" class="rounded-circle py-2" >
                </div>
                <form method="POST" action="/equipe/create" class="ml-1 mt-5" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <label for="logo">Logo equipe <span class="text-danger">*</span></label>
                            <input id="logo" type="file" accept="image/png, image/gif, image/jpeg" class="form-control" name="logo" onchange="loadfile(event)" autofocus required>
                        </div>

                        <div class="col-sm-12">
                            <label for="nome">Nome <span class="text-danger">* max 15 caracteres</span></label>
                            <input id="nome" minlength="2" maxlength="15" class="form-control form-control-lg" name="nome" type="text" placeholder="nome da equipe" aria-label=".form-control-lg" autofocus required>
                        </div>

                        <div class="col-sm-12">
                            <label for="tag">Tag <span class="text-danger">* max 5 caracteres</span></label>
                            <input id="tag" minlength="2" maxlength="5" class="form-control form-control-lg" name="tag" type="text" placeholder="tag da equipe" aria-label=".form-control-lg" autofocus required>
                        </div>

                    </div>
                    <button class="w-100 my-3 btn btn-lg btn-warning" type="submit">Criar</button>
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