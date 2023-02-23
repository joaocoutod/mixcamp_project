
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
              var ver_equipe = $('<a>', {class: 'ver-equipes btn btn-primary', href: '/equipes/'+result.id, text: 'Ver Equipe'});
  
              cardBody.append(nome_equipe, qtd_membros, ver_equipe);
              card.append(cardBody);
              col.append(card);
  
              $('#search-results').append(col);
              
          });
        }
      });
    });
  });