<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
      //obtener las recetas mas nuevas

      //$nuevas = Receta::orderBy('created_at', 'DESC')->get();
      $nuevas = Receta::latest()->take(5)->get(); //oldest

      //Obtener todas las categorias
      $categorias = CategoriaReceta::all();

      //agrupar las recetas por categoria
      $recetas = [];

      foreach ($categorias as $categoria)
      {
        $recetas[ Str::slug($categoria->nombre) ][] = Receta::where('categoria_id', $categoria->id)->take(3)->get(); 
      }

      //Str::slug($categoria->nombre) Esto lo que hace es 
      /*
          convertir de Comida Mexicana a comida-mexicana
       */

      return view('inicio.index', compact('nuevas', 'recetas'));
    }
}
