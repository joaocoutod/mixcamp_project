@extends('../layouts.main_form')

@section('title', 'Cadastro | MIXCAMP')

@section('content')

<main class="form-signin text-light">
    <div class="text-center">
        <a href="/"><img src="/img/logo.png" alt="" width="100" height="100"></a>
    </div>
    
    <form method="POST" id="login" action="/auth/cadastro" class="ml-1" style="padding-top: 10px;">
        @csrf
        <h1 class="h3 mb-2 fst-italic fw-normal text-center">Cadastro</h1>

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

        <div class="row g-3">

            <div class="col-sm-12">
                <label for="nick">Nick <span class="text-danger">*</span></label>
                <input id="nick" class="form-control form-control-lg" name="nick" type="text" placeholder="digite seu nick de player" aria-label=".form-control-lg" autofocus required>
            </div>

            <div class="col-sm-12">
                <label for="link_steam">Link Steam <span class="text-danger">*</span></label>
                <input id="link_steam" class="form-control form-control-lg" name="link_steam" type="url" placeholder="https://steamcommunity.com/id/exemple"  pattern="https://.*" aria-label=".form-control-lg" autofocus required>
            </div>

            <div class="col-sm-12">
                <label for="password">Senha <span class="text-danger">*</span></label>
                <input id="password" minlength="2" maxlength="10" class="form-control form-control-lg" name="password" type="password" placeholder="*********" aria-label=".form-control-lg" autofocus required>
            </div>

            <div class="col-sm-12">
                <label for="password-c">Confirme a Senha <span class="text-danger">*</span></label>
                <input id="password-c" minlength="2" maxlength="10" class="form-control form-control-lg" name="password_confirmation" type="password" placeholder="*********" aria-label=".form-control-lg" autofocus required>
            </div>
        </div>
        <button class="w-100 my-3 btn btn-lg btn-warning" type="submit">Cadastrar</button>

        <p class="text-center h5 mb-3 fst-italic fw-normal">Já tenho uma conta - <a href="/login" class="text-warning">ir para login</a></p>
    </form>

</main>


@endsection