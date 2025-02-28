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
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utr_id');
            $table->unsignedBigInteger('actividad_id');
            $table->unsignedBigInteger('created_by');
            $table->date('plazo_inicial');
            $table->date('plazo_final');
            $table->text('estatus', 50)->nullable()->default('Pendiente');
            $table->text('descripcion', 500)->nullable()->default('Sin descripción');
            $table->integer('numero_horas')->nullable()->default(0);
            $table->integer('cadena')->nullable()->default(0);
            $table->integer('repetible')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('utr_id')
                ->references('id')
                ->on('cat_utrs')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreign('actividad_id')
                ->references('id')
                ->on('cat_actividades')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividades');
    }
};
