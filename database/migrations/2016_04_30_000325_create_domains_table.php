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
            $table->string('name');
            $table->integer('position');
            $table->string('alias');
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
            [1,  1, 'Planning', 'Exploration & Production'],
            [1,  2, 'Development', 'Refining & Processing'],
            [1,  3, 'Distribution','Distribution'],
            [1,  4, 'Retail', 'Marketing'],

            [2,  5, 'Planning', 'Resources'],
            [2,  6, 'Development', 'Generation'],
            [2,  7, 'Distribution', 'Distribution'],
            [2,  8, 'Retail', 'Retail'],

            [3,  9, 'Planning', 'Planning'],
            [3, 10, 'Development', 'Construction'],

            [4, 11, 'Development', 'Manufacturing'],
            [4, 12, 'Distribution', 'Distribution & Logistics'],

            [5, 13, 'Development', 'Manufacturing'],
            [5, 14, 'Distribution', 'Distribution'],
            [5, 15, 'Retail', 'Retail'],

            [6, 16, 'Development', 'Manufacturing'],
            [6, 17, 'Distribution', 'Distribution & Logistics'],
            [6, 18, 'Retail', 'Retail'],

            [7, 19, 'Development', 'Development'],
            [7, 20, 'Distribution', 'Distribution'],
            [7, 21, 'Retail', 'Retail'],

            [8, 22, 'Development', 'Manufacturing'],
            [8, 23, 'Distribution', 'Distribution'],
            [8, 24, 'Retail', 'Retail & Patient Services'],

            [9, 25, 'Other', 'Other']
        );

        // Prepopulate table with fields
        foreach($feilds as $field)
        {
            DB::table('domains')->insert([
                'industry_id' => $field[0],
                'position' => $field[1],
                'alias' => $field[2],
                'name' => $field[3]
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
