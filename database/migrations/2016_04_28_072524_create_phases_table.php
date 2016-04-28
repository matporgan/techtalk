<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        // Pivot table to connect orgs and phases
        Schema::create('org_phase', function (Blueprint $table) {
            $table->integer('org_id')->unsigned()->index();
            $table->foreign('org_id')->references('id')->on('orgs')->onDelete('cascade');
            $table->integer('phase_id')->unsigned()->index();
            $table->foreign('phase_id')->references('id')->on('phases')->onDelete('cascade');
            $table->timestamps();
        });

        // Predefined fields
        $feilds = array(
            'phase1',
            'phase2',
            'phase3'
        );

        // Prepopulate table with fields
        foreach($feilds as $field)
            DB::table('phases')->insert(['name' => $field]); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('phases');
    }
}
