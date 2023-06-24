<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doc_documentos', function (Blueprint $table) {
            $table->bigIncrements('doc_id');
            $table->string('doc_nombre');
            $table->string('doc_codigo');
            $table->string('doc_contenido');
            $table->unsignedBigInteger('doc_id_proceso');
            $table->unsignedBigInteger('doc_id_tipo');
            $table->timestamps();
            $table->foreign('doc_id_proceso')->references('id')->on('pro_procesos');
            $table->foreign('doc_id_tipo')->references('id')->on('tip_tipo_docs');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_documentos');
    }
};
