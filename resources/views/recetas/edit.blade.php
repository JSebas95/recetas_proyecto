@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')  
  <a href="{{ route('recetas.index') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
    <svg class="w-6 h-6 icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
    Volver
  </a>
@endsection

@section('content')

  <h2 class="text-center mb-5">Editar receta {{ $receta->titulo }}</h2>
  
  <div class="row justify-content-center mt-5">
    <div class="col-md-8">
      <form method="POST" action="{{ route('recetas.update', $receta->id) }}" novalidate enctype="multipart/form-data">
        @csrf 
        @method('PUT')
        <div class="form-group">
          <label for="titulo"></label>
          <input type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="titulo" placeholder="Titulo receta" value="{{ $receta->titulo }}">
          
          @error('titulo')
            <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="categoria">Categoria</label>
          <select name="categoria" class="form-control  @error('categoria') is-invalid @enderror" id="categoria">

            <option value="">Seleccione</option>

            @foreach($categorias as $categoria)
              <option value="{{ $categoria->id }}" {{ $receta->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
            @endforeach

            <option value=""></option>
          </select>
          @error('categoria')
            <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group mt-3">
          <label for="preparacion">Preparacion</label>
          <input type="hidden" id="preparacion" name="preparacion" value="{{ $receta->preparacion }}">
          <trix-editor input="preparacion" class="form-control  @error('preparacion') is-invalid @enderror"></trix-editor>
          @error('preparacion')
            <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group mt-3">
          <label for="preparacion">ingredientes</label>
          <input type="hidden" id="ingredientes" name="ingredientes" value="{{ $receta->ingredientes }}">
          <trix-editor input="ingredientes" class="form-control  @error('ingredientes') is-invalid @enderror"></trix-editor>
          @error('ingredientes')
            <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group mt-3">
          <label for="imagen">Elige la imagen</label>
          <input type="file" name="imagen" id="imagen" class="form-control  @error('imagen') is-invalid @enderror">

          <div class="mt-4">
            <p>Imagen actual</p>
            <img src="/storage/{{$receta->imagen}}" style="width: 300px;">
          </div>

          @error('imagen')
            <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Editar Receta">
        </div>

      </form>
    </div>
  </div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection