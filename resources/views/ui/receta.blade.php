<div class="col-md-4 mt-4">
  <div class="card shadow">
    <img class="card-img-top" src="/storage/{{$receta->imagen}}" alt="Imagen">
    <div class="card-body">
      <h3 class="card-title"> {{ $receta->titulo }} </h3>
      <div class="meta-receta d-flex justify-content-between">
        <p class="text-primary fecha font-weight-bold">
          {{ $receta->created_at}}
        </p>
      </div>
      <p>{{ Str::limit(strip_tags($receta->preparacion),50, '...') }}</p> {{-- Para que solo imprima las primeras 50 letras de la preparacion--}}
      <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-primary d-block btn-recea">Ver Receta</a>
    </div>
  </div>
</div>