@extends('layouts.main')

@section('title', 'Equipes | MIXCAMP')

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
                <div class="card card-cover  overflow-hidden text-bg-light rounded-4 shadow-lg">
                    <div class="d-flex flex-column  p-5 pb-5 text-dark text-shadow-1 text-center align-items-center">
                        <h3 class="nome-equipe display-6 fw-bold ">{{$equipe->nome}}</h3>
                        <p class="qtd-membros mb-2 fs-5 fw-bold">Membros: {{$equipe->qtd_membros}}</p>
                        <a class="ver-equipes btn btn-primary" href="http://127.0.0.1:8000/equipes/{{$equipe->id}}">Ver Equipe</a>
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
<script>

$(document).ready(function() {
  // Quando o usuário digita algo no campo de pesquisa
  $('#search-input').on('input', function() {
    // Obtém o valor do campo de pesquisa
    var query = $(this).val();

    // Faz a requisição AJAX para o servidor
    $.ajax({
      url: '/busca/equipes',
      method: 'GET',
      data: { query: query },
      success: function(response) {
        // Limpa o container de resultados
        $('#search-results').empty();

        // Verifica se o resultado da pesquisa está vazio
        if (response.length === 0) {
            var resulvazio = $('<p>', { class: 'fs-5 fw-bold', text: 'Nenhuma equipe foi encontrada :(' });
            $('#search-results').append(resulvazio);
            return;
        }

        // Exibe os resultados da pesquisa em cards
        response.forEach(function(result) {
            var col = $('<div>', { class: 'col' });
            var card = $('<div>', { class: 'card card-cover overflow-hidden bg-light rounded-4 shadow-lg ' });
            var cardBody = $('<div>', { class: 'body-content d-flex flex-column  p-5 pb-5 text-dark text-shadow-1 text-center align-items-center' });
            var nome_equipe = $('<h3>', { class: 'nome-equipe display-6 fw-bold ', text: result.nome });
            var qtd_membros = $('<p>', { class: 'qtd-membros mb-2 fs-5 fw-bold', text: 'Membros: '+result.qtd_membros });
            var ver_equipe = $('<a>', {class: 'ver-equipes btn btn-primary', href: 'http://127.0.0.1:8000/equipes/'+result.id, text: 'Ver Equipe'});

            cardBody.append(nome_equipe, qtd_membros, ver_equipe);
            card.append(cardBody);
            col.append(card);

            $('#search-results').append(col);
            
        });
      }
    });
  });
});


</script>

@endsection