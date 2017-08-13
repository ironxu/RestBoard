<?php

use Illuminate\Database\Seeder;

class EnvTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('envs')->insert([
            [
                'app_id' => 4,
                'name' => 'dev',
                'url' => 'rb.local.com',
                'host' => '127.0.0.1',
                'color' => '#ffffff',
                'remark' => '开发环境',
                'opname' => 'admin',
                'created_at' => '2017-08-13 13:08:36',
                'updated_at' => '2017-08-13 13:08:36',
            ],
            [
                'app_id' => 4,
                'name' => 'test',
                'url' => 'test.rb.local.com',
                'host' => '127.0.0.1',
                'color' => '#ff99ff',
                'remark' => '测试环境',
                'opname' => 'admin',
                'created_at' => '2017-08-13 13:08:36',
                'updated_at' => '2017-08-13 13:08:36',
            ],
        ]);
    }
}
