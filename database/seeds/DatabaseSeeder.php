<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AppTableSeeder::class);
        $this->call(EnvTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ApiTableSeeder::class);
        $this->call(RequestTableSeeder::class);
    }
}
