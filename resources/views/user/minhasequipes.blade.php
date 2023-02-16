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
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $team)
                    <tr>
                        <th scope="row">
                            <img src="/img/teams/logo/{{$team->logo}}" width="50" height="50" class="rounded-circle">
                            {{$team->nome}}
                        </th>
                        <td class="p-4">{{$team->tag}}</td>
                        <td class="p-4">{{$team->qtd_membros}}</td>
                        <td class="p-3 text-center">
                            <div class="text-center">
                                <a href="/equipes/{{$team->id}}" class="btn btn-success m-1">Ver</a>
                                <a data-bs-toggle="modal" data-bs-target="#deletarTeam{{$team->id}}" class="btn btn-danger m-1" href="#">deletar</a>
                            </div>
                            
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
            <div class="text-center py-5">
                <a href="/criarequipe" class="btn btn-outline-warning p-3">Criar Equipe</a>
            </div>
            @else

                <div class="text-center py-5">
                    <h1 class="text-center">Ainda não tem equipes</h1>
                    <a href="/criarequipe" class="btn btn-outline-warning p-3">Criar Equipe</a>
                </div>
                

            @endif
        </div>

        
        
    </div>
</div>

@endsection