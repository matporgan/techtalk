<?php

use Illuminate\Database\Seeder;

class OrgTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(App\Org::class, 10)->create();
		factory(App\User::class, 10)->create();
    }
}
