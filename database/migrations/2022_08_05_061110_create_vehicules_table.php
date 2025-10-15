<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('PlaqueImmatric')->unique();
            $table->string('Vehicule');
            $table->string('Energie');
            $table->integer('Consommation');
            $table->integer('CV');
            $table->Date('DateEntree');
            $table->Date('AnneeMenCirc');
            $table->integer('KMActuel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicules');
    }
}
