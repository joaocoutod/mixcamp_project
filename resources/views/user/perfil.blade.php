@extends('../layouts.main')

@section('title', 'Perfil')

@section('content')
    <div class="container-fluid text-light text-center ">
        
        <div class="profile pt-5">
            <img src="/img/logo.png" width="200" height="200" class="rounded-circle py-2">
            
            <h2>{{ $user->nick }}</h2>
            

            <div class="p-2">
                <div class="row g-3 justify-content-center">
                    @if(Auth::check() == true)
                        @if(Auth::user()->nick == $user->nick)
                    <div class="col-sm-6">
                        <a href="#" class="btn btn-warning">Configuração de conta </a>
                        <a href="#" class="btn btn-outline-warning m-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                                <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                            </svg>
                        </a>
                    </div>
                        @endif
                    @endif
                </div>  
            </div>

            <div class="midia-social py-4">
                <div class="row g-3 justify-content-center">

                    <div class="col-sm-3">
                        @if(Auth::check() == true)
                            @if(Auth::user()->nick == $user->nick)
                            <a href="/perfil/equipes" class="btn btn-success w-100 btn-lg mb-3" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                </svg>
                                Equipe
                            </a>
                            @endif
                        @endif

                        @if($user->link_steam)
                        <a href="{{$user->link_steam}}" class="btn btn-primary w-100 btn-lg mb-3" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-steam" viewBox="0 0 16 16">
                                <path d="M.329 10.333A8.01 8.01 0 0 0 7.99 16C12.414 16 16 12.418 16 8s-3.586-8-8.009-8A8.006 8.006 0 0 0 0 7.468l.003.006 4.304 1.769A2.198 2.198 0 0 1 5.62 8.88l1.96-2.844-.001-.04a3.046 3.046 0 0 1 3.042-3.043 3.046 3.046 0 0 1 3.042 3.043 3.047 3.047 0 0 1-3.111 3.044l-2.804 2a2.223 2.223 0 0 1-3.075 2.11 2.217 2.217 0 0 1-1.312-1.568L.33 10.333Z"/>
                                <path d="M4.868 12.683a1.715 1.715 0 0 0 1.318-3.165 1.705 1.705 0 0 0-1.263-.02l1.023.424a1.261 1.261 0 1 1-.97 2.33l-.99-.41a1.7 1.7 0 0 0 .882.84Zm3.726-6.687a2.03 2.03 0 0 0 2.027 2.029 2.03 2.03 0 0 0 2.027-2.029 2.03 2.03 0 0 0-2.027-2.027 2.03 2.03 0 0 0-2.027 2.027Zm2.03-1.527a1.524 1.524 0 1 1-.002 3.048 1.524 1.524 0 0 1 .002-3.048Z"/>
                            </svg>
                            Steam
                        </a>
                        @endif

                        @if($user->link_gamesclub != 'x')
                        <a href="#" class="btn btn-light w-100 btn-lg" target="_blank">
                            <img src="/img/icon/gc.png" alt="" width="20" height="20">
                            Gamesclub
                        </a>
                        @endif

                    </div><!-- col-3 -->

                </div> <!-- row -->
            </div><!-- social midia-->
            
        </div>
    </div>

    
@endsection