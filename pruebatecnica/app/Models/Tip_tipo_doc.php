<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip_tipo_doc extends Model
{
    use HasFactory;
    // Definimos la relacion de la tabla "tip_tipo_doc" la cual indica que esta puede tener un solo "doc_documento"
    protected $table='tip_tipo_docs';
    protected $primarykey='id';
    public function doc_documento(){
        return $this->belongsTo(Doc_documento::class,'doc_id_tipo','id');
    }
}
