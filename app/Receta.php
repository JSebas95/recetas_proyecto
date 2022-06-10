<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'titulo', 'preparacion', 'ingredientes', 'imagen', 'categoria_id'
    ];

    //Obtiene la caterogia de la receta via PK
    public function categoria()
    {
      return $this->belongsTo(CategoriaReceta::class);
    }


    public function autor()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
