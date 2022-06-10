<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth', ['except' => ['show', 'search']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //$recetas = Auth::user()->recetas;

        $usuario_id = auth()->user()->id; 
        
        //Recetas con paginacion
        $recetas = Receta::where('user_id', $usuario_id)->paginate(2);

        return view('recetas.index', compact('recetas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Obtener categoria sin modelo
        //$categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');

        //con modelo
        $categorias = CategoriaReceta::all('id', 'nombre');

        return view('recetas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion
        $data = $request->validate([
          'titulo' => 'required|min:6',
          'categoria' => 'required',
          'preparacion' => 'required',
          'ingredientes' => 'required',
          'imagen' => 'required|image',
        ]);

        //obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        //Resize la imagen
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();

        //Almacenamiento
        /*DB::table('recetas')->insert([
          'titulo' => $data['titulo'],
          'ingredientes' => $data['ingredientes'],
          'preparacion' => $data['preparacion'],
          'user_id' => Auth::user()->id,
          'categoria_id' => $data['categoria'],
          'imagen' => $ruta_imagen
        ]);*/

        Auth::user()->recetas()->create([
          'titulo' => $data['titulo'],
          'ingredientes' => $data['ingredientes'],
          'preparacion' => $data['preparacion'],
          'categoria_id' => $data['categoria'],
          'imagen' => $ruta_imagen
        ]);

        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //Metodos para obtener receta
        //$receta = Receta::find(1);
        //$receta = Receta::findOrFail(1);

        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
      $this->authorize('view', $receta);

      $categorias = CategoriaReceta::all('id', 'nombre');

      return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //revisar el policy
        $this->authorize('update', $receta);

        //validacion
        $data = $request->validate([
          'titulo' => 'required|min:6',
          'categoria' => 'required',
          'preparacion' => 'required',
          'ingredientes' => 'required'
        ]);

        $receta->titulo       = $data['titulo'];
        $receta->categoria_id = $data['categoria'];
        $receta->preparacion  = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];

        if (request('imagen'))
        {
          $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

          //Resize la imagen
          $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
          $img->save();

          $receta->imagen = $ruta_imagen;
        }

        $receta->save();

        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    { 
        //policy
        $this->authorize('delete', $receta);

        $receta->delete();

        return redirect()->action('RecetaController@index');
    }

    public function search(Request $request)
    {
      //$busqueda = $request['buscar'];
      $busqueda = $request->get('buscar');
      $recetas  = Receta::where('titulo', 'like', '%'.$busqueda.'%')->paginate(1);
      $recetas->appends(['buscar' => $busqueda]);

      return view('busquedas.show', compact('recetas', 'busqueda'));
    }
}
