<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('industry_id')->unsigned()->index();
            $table->foreign('industry_id')->references('id')->on('industries')->onDelete('cascade');            
            $table->string('position');
            $table->string('name');
            $table->timestamps();
        });

        // Pivot table to connect orgs and phases
        Schema::create('org_domain', function (Blueprint $table) {
            $table->integer('org_id')->unsigned()->index();
            $table->foreign('org_id')->references('id')->on('orgs')->onDelete('cascade');
            $table->integer('domain_id')->unsigned()->index();
            $table->foreign('domain_id')->references('id')->on('domains')->onDelete('cascade');
            $table->timestamps();
        });

        // Predefined fields
        $feilds = array(
            [1, 1, 'Exploration & Production'],
            [1, 2, 'Refining & Processing'],
            [1, 3, 'Distribution'],
            [1, 4, 'Marketing'],

            [2, 1, 'Resources'],
            [2, 2, 'Generation'],
            [2, 3, 'Distribution'],
            [2, 4, 'Retail'],

            [3, 1, 'Planning'],
            [3, 2, 'Construction'],

            [4, 2, 'Manufacturing'],
            [4, 3, 'Distribution & Logistics'],

            [5, 2, 'Manufacturing'],
            [5, 3, 'Distribution'],
            [5, 4, 'Retail'],

            [6, 2, 'Manufacturing'],
            [6, 3, 'Distribution & Logistics'],
            [6, 4, 'Retail'],

            [7, 2, 'Development'],
            [7, 3, 'Distribution'],
            [7, 4, 'Retail'],

            [8, 2, 'Manufacturing'],
            [8, 3, 'Distribution'],
            [8, 4, 'Retail & Patient Services'],

            [9, 5, 'Other']
        );

        // Prepopulate table with fields
        foreach($feilds as $field)
        {
            DB::table('domains')->insert([
                'industry_id' => $field[0],
                'name' => $field[1],
                'position' => $field[2]
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
        Schema::drop('org_domain');
        Schema::drop('domains');
    }
}
