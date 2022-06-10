<?php

namespace App\Providers;

use App\CategoriaReceta;
use Illuminate\Support\ServiceProvider;
use View;

class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register() // Se coloca al configurar el proyecto, antes de que laravel inicia
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() // Se ejectuta todo cuando la aplicacion esta lista
    {
        View::composer('*', function($view){
          $categorias = CategoriaReceta::all();
          $view->with('categorias', $categorias);
        });
    }
}
