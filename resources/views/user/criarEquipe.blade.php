@extends('layouts.main')

@section('title', 'Criar Time | MIXCAMP')

@section('content')

<div class="container-fluid bg-light">

    <div class="row justify-content-center">

        <div class="col-sm-4">
            <main class="form-signin text-dark">
                
                <form method="POST" action="/equipe/create" class="ml-1 mt-5" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <h1 class="h3 mb-2 fst-italic fw-normal text-center">Criar Equipe</h1>

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

                    <div class="row justify-content-center text-center">
                        <div class="col-md-3">
                            <img id="output" width="200" height="200" class="rounded-circle py-2" >
                        </div>
                    </div>

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

            </main>
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