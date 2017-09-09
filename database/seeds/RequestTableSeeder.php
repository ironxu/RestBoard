<?php

use Illuminate\Database\Seeder;

class RequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requests')->insert([
            [
                'app_id' => 4,
                'api_id' => 32,
                'cate_id' => 1,
                'env_id' => 10,
                'name' => '名称',
                'description' => '描述',
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
                'api_id' => 32,
                'cate_id' => 1,
                'env_id' => 10,
                'name' => '名称',
                'description' => '描述',
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
