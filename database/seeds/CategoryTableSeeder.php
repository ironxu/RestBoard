<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'app_id' => 4,
                'name' => '一级1',
                'pid' => 0,
                'sort' => 1,
                'remark' => '一级分类',
                'opname' => 'admin',
                'created_at' => '2017-08-13 13:08:36',
                'updated_at' => '2017-08-13 13:08:36',
            ],
            [
                'app_id' => 4,
                'name' => '一级2',
                'pid' => 0,
                'sort' => 2,
                'remark' => '一级分类',
                'opname' => 'admin',
                'created_at' => '2017-08-13 13:08:36',
                'updated_at' => '2017-08-13 13:08:36',
            ],
            [
                'app_id' => 4,
                'name' => '二级1.1',
                'pid' => 1,
                'sort' => 1,
                'remark' => '二级分类',
                'opname' => 'admin',
                'created_at' => '2017-08-13 13:08:36',
                'updated_at' => '2017-08-13 13:08:36',
            ],
        ]);
    }
}
