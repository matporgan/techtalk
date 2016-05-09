<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technologies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position');
            $table->string('subcategory');
            $table->string('name');
            $table->timestamps();
        });

        // Pivot table to connect orgs and technologies
        Schema::create('org_technology', function (Blueprint $table) {
            $table->integer('org_id')->unsigned()->index();
            $table->foreign('org_id')->references('id')->on('orgs')->onDelete('cascade');
            $table->integer('technology_id')->unsigned()->index();
            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('cascade');
            $table->timestamps();
        });

       // Predefined fields
        $feilds = array(
            [1 , 'Emerging', 'Advanced Materials'],
            [2 , 'Emerging', 'Hydrogen'],
            [3 , 'Emerging', 'Neurotechnology'],
            [4 , 'Emerging', 'Advanced Nanotechnology'],

            [5 , 'Stable', 'IT Infrastructure'],
            [6 , 'Stable', 'Telecommunications'],
            [7 , 'Stable', 'Enterprise Software'],
            [8 , 'Stable', 'Software Development'],
            [9 , 'Stable', 'Operations Systems'],
            [10, 'Stable', 'Visualization'],
            [11, 'Stable', 'Digitization'],
            [12, 'Stable', 'Computer Aided Design'],
            [13, 'Stable', 'Computer Aided Construction'],

            [14, 'Accelerating', 'Internet of Things / Cybersecurity'],
            [15, 'Accelerating', 'Machine Learning / Artificial Intelligence'],
            [16, 'Accelerating', 'Cloud Computing / Cloud-Based Platforms'],
            [17, 'Accelerating', 'Big Data / Open Data'],
            [18, 'Accelerating', 'Real-Time and Predictive Analytics'],
            [19, 'Accelerating', 'Unmanned Ariel Vehicles /  Nanosatellites'],
            [20, 'Accelerating', 'Wearables / VR / AR'],
            [21, 'Accelerating', 'Computer Vision / Image Recognition'],
            [22, 'Accelerating', '3D Printing'],
            [23, 'Accelerating', 'Robotics / Autonomous Vehicles'],
            [24, 'Accelerating', 'Electric Vehicles'],
            [25, 'Accelerating', 'Solar PV / Electricity Storage'],
            [26, 'Accelerating', 'eMoney'],

            [27, 'Other', 'Other'],
        );

        // Prepopulate table with fields
        foreach($feilds as $field)
        {
            DB::table('technologies')->insert([
                'position' => $field[0],
                'subcategory' => $field[1],
                'name' => $field[2]
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
        Schema::drop('org_technology');
        Schema::drop('technologies');
    }
}
