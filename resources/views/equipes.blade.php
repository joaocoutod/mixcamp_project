@extends('layouts.main')

@section('title', 'Equipes | MIXCAMP')
@section('description', 'Pesquisar por equipes na MixCamp')
@section('url', '/equipes')

@section('content')

<div class="container text-light">
    <div class="text-center py-4">
        <h1 class="display-5">Pesquisar Times</h1>
    </div>
    
    <div class="row g-3 justify-content-center pb-4">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input id="search-input" type="text" class="form-control" placeholder="Busca por nome" aria-label="Busca por nome" aria-describedby="button-addon2">
            </div>
        </div>

    </div>
</div>


<!-- EQUIPES -->
@if(count($equipes) > 0)
<div class="container-fluid text-light text-center ">
    <div class="container p-4" id="custom-cards">
        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4  justify-content-center" id="search-results">
            @foreach($equipes as $equipe)
            <div class="col">
                <div class="card card-cover overflow-hidden text-bg-dark rounded-4 shadow-lg border">
                    <div class="d-flex flex-column  p-4 pb-4 text-light text-shadow-1 text-center align-items-center">
                        <img src="/img/teams/logo/{{$equipe->logo}}" width="150" height="150" class="rounded-circle ">
                        <h3 class="nome-equipe display-7 fw-bold py-3">{{$equipe->nome}}</h3>
                        <a class="ver-equipes btn btn-primary" href="/equipes/{{$equipe->id}}">Ver Equipe</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@else
<div class="container text-light text-center ">
    <div class="container p-4">
        <h3 class="fs-5 fw-bold">Nenhuma equipe foi encontrada :(</h3>
    </div>
</div>
@endif
<!-- /EQUIPES -->



<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="/js/equipes-busca.js"></script>

@endsection