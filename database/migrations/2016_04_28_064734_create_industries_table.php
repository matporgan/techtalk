<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position');
            $table->string('name');
            $table->timestamps();
        });

        // Pivot table to connect orgs and industries
        Schema::create('org_industry', function (Blueprint $table) {
            $table->integer('org_id')->unsigned()->index();
            $table->foreign('org_id')->references('id')->on('orgs')->onDelete('cascade');
            $table->integer('industry_id')->unsigned()->index();
            $table->foreign('industry_id')->references('id')->on('industries')->onDelete('cascade');
            $table->timestamps();
        });

        // Predefined fields
        $feilds = array(
            [1, 'Energy & Resources'],
            [2, 'Utilities'],
            [3, 'Built Environment'],
            [4, 'Transport & Logistics'],
            [5, 'Automotive & Manufacturing'],
            [6, 'Aerospace & Defence'],
            [7, 'Telecom'],
            [8, 'Healthcare'],
            [9, 'Other']
        );

        // Prepopulate table with fields
        foreach($feilds as $field)
        {
            DB::table('industries')->insert([
                'position' => $field[0],
                'name' => $field[1],
            ]);   
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('org_industry');
        Schema::drop('industries');
    }
}
