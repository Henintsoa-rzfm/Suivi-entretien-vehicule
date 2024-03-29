<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->string('nature');
            $table->date('DateIntervention');
            $table->date('DateLimite');
            $table->string('Panne');
            $table->string('lieuIntervention');
            $table->string('Validation');
            $table->foreignId('mecanicien_id')->constrained();
            $table->foreignId('vehicule_id')->constrained();
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
        Schema::dropIfExists('interventions');
    }
}
