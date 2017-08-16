<?php

use Illuminate\Database\Seeder;

class ApiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('apis')->insert([
            [
                'app_id' => 4,
                'cate_id' => 2,
                'name' => 'APP1',
                'description' => 'description of app3',
                'method' => 'GET',
                'uri' => 'apps',
                'req_header' => '',
                'req_body' => '',
                'resp_header' => '', // 通过request 进行回填
                'resp_body' => '', // 通过request 进行回填
                'remark' => 'remark of api1',
                'opname' => 'admin',
                'created_at' => '2017-08-16 13:08:36',
                'updated_at' => '2017-08-16 13:08:36',
            ],
            [
                'app_id' => 4,
                'cate_id' => 2,
                'name' => 'APP2',
                'description' => 'description of app3',
                'method' => 'GET',
                'uri' => 'apps',
                'req_header' => '',
                'req_body' => '',
                'resp_header' => '', // 通过request 进行回填
                'resp_body' => '', // 通过request 进行回填
                'remark' => 'remark of api1',
                'opname' => 'admin',
                'created_at' => '2017-08-16 13:08:36',
                'updated_at' => '2017-08-16 13:08:36',
            ],
            [
                'app_id' => 4,
                'cate_id' => 2,
                'name' => 'APP3',
                'description' => 'description of app3',
                'method' => 'GET',
                'uri' => 'apps',
                'req_header' => '',
                'req_body' => '',
                'resp_header' => '', // 通过request 进行回填
                'resp_body' => '', // 通过request 进行回填
                'remark' => 'remark of api1',
                'opname' => 'admin',
                'created_at' => '2017-08-16 13:08:36',
                'updated_at' => '2017-08-16 13:08:36',
            ],
        ]);
    }
}
