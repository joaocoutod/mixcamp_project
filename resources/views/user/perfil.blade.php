@extends('../layouts.main')

@section('title', 'Perfil | '.$user->nick)
@section('description', 'Veja esse perfil na MixCamp')
@section('url', '/user/'.$user->id)


@section('content')
    <div class="container-fluid text-light text-center pt-5">

        <!-- RETURN -->
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

        <img src="/img/users/logo/{{$user->foto}}" width="200" height="200" class="rounded-circle py-2">
        <h2>{{ $user->nick }}</h2>
    

        <div class="row g-3 justify-content-center pb-5">
            <div class="col-md-3">

                @if(//VERIFICA SE ESTAR LOGADO E SE É O PERFIL DO USUARIO LOGADO
                    (Auth::check() == true) && (Auth::user()->id == $user->id))
                    <a href="#" class="btn btn-warning  mb-4" data-bs-toggle="modal" data-bs-target="#editarUser{{$user->id}}">
                        Configuração de conta 
                    </a>

                    <a href="/perfil/equipes" class="btn btn-success w-100 btn-lg mb-3" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                        </svg>
                        Equipes
                    </a>
                @endif

                @if($user->link_steam != 'null')
                    <a href="{{$user->link_steam}}" class="btn btn-primary w-100 btn-lg mb-3" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-steam" viewBox="0 0 16 16">
                            <path d="M.329 10.333A8.01 8.01 0 0 0 7.99 16C12.414 16 16 12.418 16 8s-3.586-8-8.009-8A8.006 8.006 0 0 0 0 7.468l.003.006 4.304 1.769A2.198 2.198 0 0 1 5.62 8.88l1.96-2.844-.001-.04a3.046 3.046 0 0 1 3.042-3.043 3.046 3.046 0 0 1 3.042 3.043 3.047 3.047 0 0 1-3.111 3.044l-2.804 2a2.223 2.223 0 0 1-3.075 2.11 2.217 2.217 0 0 1-1.312-1.568L.33 10.333Z"/>
                            <path d="M4.868 12.683a1.715 1.715 0 0 0 1.318-3.165 1.705 1.705 0 0 0-1.263-.02l1.023.424a1.261 1.261 0 1 1-.97 2.33l-.99-.41a1.7 1.7 0 0 0 .882.84Zm3.726-6.687a2.03 2.03 0 0 0 2.027 2.029 2.03 2.03 0 0 0 2.027-2.029 2.03 2.03 0 0 0-2.027-2.027 2.03 2.03 0 0 0-2.027 2.027Zm2.03-1.527a1.524 1.524 0 1 1-.002 3.048 1.524 1.524 0 0 1 .002-3.048Z"/>
                        </svg>
                        Steam
                    </a>
                @endif

                @if($user->link_faceit != 'null')
                    <a href="{{$user->link_faceit}}" class="btn btn-light w-100 btn-lg" target="_blank">
                        <img src="/img/icon/faceit.png" alt="" width="20" height="20">
                        Faceit
                    </a>
                @endif

            </div><!-- colsss-3 -->
        </div> <!-- row de links -->

    </div><!-- container -->



    <!-- EQUIPES QUE O USUARIO CRIOU -->
    @if(count($equipes) > 0)
    <div class="container-fluid text-light text-center ">
        <h3>[ Equipes ]</h3>
        <div class="container p-4" id="custom-cards">
            <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4  justify-content-center" id="search-results">
                @foreach($equipes as $equipe)
                <div class="col">
                    <div class="card card-cover  overflow-hidden text-bg-light rounded-4 shadow-lg">
                        <div class="d-flex flex-column  p-5 pb-5 text-dark text-shadow-1 text-center align-items-center">
                            <h3 class="nome-equipe display-6 fw-bold ">{{$equipe->nome}}</h3>
                            <p class="qtd-membros mb-2 fs-5 fw-bold">Membros: {{$equipe->qtd_membros}}</p>
                            <a class="ver-equipes btn btn-primary" href="/equipes/{{$equipe->id}}">Ver Equipe</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div><!-- /EQUIPES -->
    @endif


    <!-- MODAL EDITAR EQUIPE -->
    <div class="modal fade" id="editarUser{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- BOTAO FECHAR -->
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- CONTEUDO -->
                <div class="modal-body text-dark">
                    <div class="row g-3">   

                        <input type="hidden" id="id_user" name="id_user" value="{{$user->id}}">
                        @if(Auth::check() == true)
                            <input type="hidden" id="authcheck" value="1">
                        @else
                            <input type="hidden" id="authcheck" value="0">                                        
                        @endif

                        <!-- PREVIEW FOTO -->
                        <div class="text-center">
                            <div class="">
                                <img id="output" width="200" height="200" src="/img/users/logo/{{$user->foto}}" class="rounded-circle py-2" >
                            </div>
                        </div>

                        <!-- FOTO -->
                        <form method="POST" action="/user/alterar/alterarlogo" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_user" value="{{$user->id}}">
                            <div class="col-sm-12">
                                <label for="foto">Foto de perfil<span class="text-danger">*</span></label>
                                <input id="foto" type="file" accept="image/png, image/gif, image/jpeg" class="form-control" name="foto" onchange="loadfile(event)" autofocus required>
                            </div>
                            <button class="w-100 my-3 btn btn-lg btn-warning" type="submit">Alterar Foto</button>
                        </form>
                        
                        <!-- Nick -->
                        <form method="POST" action="/user/alterar/alterarnick">
                            @csrf
                            <input type="hidden" name="id_user" value="{{$user->id}}">
                            <div class="col-sm-12">
                                <label for="nick">Nick <span class="text-danger">* (esse é o nick de login)</span></label>
                                <input id="nick" minlength="2" maxlength="15" class="form-control form-control-lg" name="nick" type="text" value="{{$user->nick}}" aria-label=".form-control-lg" autofocus required>
                            </div>
                            <button class="w-100 my-3 btn btn-lg btn-warning" type="submit">Alterar Nick</button>
                        </form>

                        <!-- LINKSTEAM -->
                        <form method="POST" action="/user/alterar/alterarlinksteam">
                            @csrf
                            <input type="hidden" name="id_user" value="{{$user->id}}">
                            <div class="col-sm-12">
                                <label for="linksteam">Link steam <span class="text-danger">*</span></label>
                                @if($user->link_steam == 'null')
                                <input id="linksteam" class="form-control form-control-lg" name="linksteam" type="url" type="url" value=""  pattern="https://steamcommunity.com.*" aria-label=".form-control-lg">
                                @else
                                <input id="linksteam" class="form-control form-control-lg" name="linksteam" type="url" type="url" value="{{$user->link_steam}}"  pattern="https://steamcommunity.com.*" aria-label=".form-control-lg">
                                @endif
                            
                            </div>
                            <button class="w-100 my-3 btn btn-lg btn-warning" type="submit">Alterar Link Steam</button>
                        </form>

                        <!-- LINKFACEIT -->
                        <form method="POST" action="/user/alterar/alterarlinkfaceit">
                            @csrf
                            <input type="hidden" name="id_user" value="{{$user->id}}">
                            <div class="col-sm-12">
                                <label for="linkfaceit">Link faceit <span class="text-danger">*</span></label>
                                @if($user->link_faceit == 'null')
                                <input id="linkfaceit" class="form-control form-control-lg" name="linkfaceit" type="url"  type="url" value=""  pattern="https://www.faceit.com/.*" aria-label=".form-control-lg">
                                @else
                                <input id="linkfaceit" class="form-control form-control-lg" name="linkfaceit" type="url"  type="url" value="{{$user->link_faceit}}"  pattern="https://www.faceit.com/.*" aria-label=".form-control-lg">
                                @endif
                            </div>
                            <button class="w-100 my-3 btn btn-lg btn-warning" type="submit">Alterar Link Faceit</button>
                        </form>
                        

                        <!-- SENHA -->
                        <form method="POST" action="/user/alterar/alterarsenha">
                            @csrf
                            <input type="hidden" name="id_user" value="{{$user->id}}">
                            <div class="col-sm-12 pb-2">
                                <label for="senha">Senha Atual<span class="text-danger">*</span></label>
                                <input id="senha" minlength="2" maxlength="10" class="form-control form-control-lg" name="senha" type="password" placeholder="******" aria-label=".form-control-lg" autofocus required>
                            </div>
                            <div class="col-sm-12 pb-2">
                                <label for="novasenha">Nova Senha<span class="text-danger">*</span></label>
                                <input id="novasenha" minlength="2" maxlength="10" class="form-control form-control-lg" name="senhanova" type="password" placeholder="******" aria-label=".form-control-lg" autofocus required>
                            </div>
                            <div class="col-sm-12 pb-2">
                                <label for="confnovasenha">Confirme a nova senha<span class="text-danger">*</span></label>
                                <input id="confnovasenha" minlength="2" maxlength="10" class="form-control form-control-lg" name="confnovasenha" type="password" placeholder="******" aria-label=".form-control-lg" autofocus required>
                            </div>
                            <button class="w-100 my-3 btn btn-lg btn-warning" type="submit">Alterar Senha</button>
                        </form>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>    


<script src="/js/equipe-perfil.js"></script>
@endsection