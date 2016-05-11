<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        // Pivot table to connect orgs and phases
        Schema::create('org_tag', function (Blueprint $table) {
            $table->integer('org_id')->unsigned()->index();
            $table->foreign('org_id')->references('id')->on('orgs')->onDelete('cascade');
            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
        });

        // Predefined fields
        $feilds = array(
            ['tag1', 2],
            ['tag2', 5],
            ['tag3', 1]
        );

        // Prepopulate table with fields
        foreach($feilds as $field)
        {
            DB::table('tags')->insert([
                'name' => $field[0],
                'count' => $field[1],
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
        Schema::drop('org_tag');
        Schema::drop('tags');
    }
}
