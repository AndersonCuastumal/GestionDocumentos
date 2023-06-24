<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc_documento extends Model
{
    use HasFactory;
    protected $primaryKey = 'doc_id'; // Al especificar $primaryKey = 'doc_id', le estás indicando a Laravel que la columna "doc_id" es la clave primaria en lugar de la columna "id" predeterminada.

    protected $table = "doc_documentos";

    protected $fillable = [
        'doc_nombre',
        'doc_codigo',
        'doc_contenido',
        'doc_id_tipo',
        'doc_id_proceso'];

    // Método para retornar todos los documentos registrados
    
    public function getAllDocuments()
    {
        return $this->Doc_documento::all();
    }
    // Relaciones ORM (relaciones entre tablas de una DB relacional)
    // Creamos la relacion ORM con la tabla "pro_procesos", indica que un doc_documento puede tener varios pro_procesos
    public function pro_procesos(){
        return $this->hasMany(Pro_proceso::class,'id','doc_id_proceso');
    }

    // Creamos la relacion ORM con la tabla "tipo_doc"
    public function tip_tipo_docs(){
        return $this->hasMany(Tip_tipo_doc::class,'id','doc_id_tipo');
    }
}
