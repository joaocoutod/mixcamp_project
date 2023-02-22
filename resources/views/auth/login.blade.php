
@extends('../layouts.main_form')

@section('title', 'Login | MIXCAMP')

@section('content')



<main class="form-signin text-light">
    <div class="text-center">
        <a href="/"><img src="/img/logo.png" alt="" width="100" height="100"></a>
    </div>
    
    <form method="POST" action="/auth/login" class="ml-1" style="padding-top: 40px;padding-bottom: 40px;">
        @csrf
        <h1 class="h3 mb-3 fst-italic fw-normal text-center">Login</h1>
        
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
                <input id="nick" class="form-control form-control-lg" name="nick" type="nick" placeholder="nickname" aria-label=".form-control-lg" autofocus required>
            </div>


            <div class="col-sm-12">
                <label for="password">Senha <span class="text-danger">*</span></label>
                <input id="password" class="form-control form-control-lg" name="password" type="password" placeholder="*********" aria-label=".form-control-lg" autofocus required>
            </div>

        </div>
        <button class="w-100 my-3 btn btn-lg btn-warning" type="submit">Login</button>
    </form>

    <p class="text-center h5 mb-3 fst-italic fw-normal">Não tenho cadastro - <a href="/cadastro" class="text-warning">Cadastre-se</a></p>
</main>


@endsection
