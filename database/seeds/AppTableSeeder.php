<?php

use Illuminate\Database\Seeder;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('apps')->insert([
            [
                'name' => 'APP1',
                'description' => 'description of app1',
                'remark' => 'remark of app1',
                'opname' => 'admin',
                'created_at' => '2017-08-13 13:08:36',
                'updated_at' => '2017-08-13 13:08:36',
            ],
            [
                'name' => 'APP1',
                'description' => 'description of app1',
                'remark' => 'remark of app1',
                'opname' => 'admin',
                'created_at' => '2017-08-13 13:08:36',
                'updated_at' => '2017-08-13 13:08:36',
            ],
        ]);
    }
}
