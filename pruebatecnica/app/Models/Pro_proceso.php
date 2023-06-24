<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pro_proceso extends Model
{
    use HasFactory;
    // Definimos la relacion de la tabla "pro_proceso" la cual indica que esta puede tener un solo "doc_documento"
    // Relaciones ORM
    protected $table='pro_procesos';
    protected $primarykey='id';
    public function doc_documento(){
        return $this->belongsTo(Doc_documento::class,'doc_id_proceso','id');
    }
}
