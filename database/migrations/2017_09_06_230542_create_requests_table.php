<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            
            // 应用信息与api 描述
            $table->unsignedInteger('app_id')->comment('应用ID');
            $table->unsignedInteger('api_id')->comment('APIID');
            $table->unsignedInteger('cate_id')->comment('分类ID');
            $table->unsignedInteger('env_id')->comment('环境ID');
            $table->string('name', 50)->default('')->comment('request 名称');
            $table->string('description', 200)->default('')->comment('request 描述');

            // 请求地址
            $table->char('method', 7)->default('')->comment('http method: get, post, put, delete, options, patch');
            $table->string('uri', 200)->default('')->comment('request 请求资源');

            // 请求信息
            $table->text('req_header')->comment('request 请求头');
            $table->text('req_body')->comment('request 请求体');

            // 响应信息
            $table->text('resp_header')->comment('request 响应头');
            $table->text('resp_body')->comment('request 响应体');

            // 备注信息
            $table->string('remark', 200)->default('')->comment('备注');
            $table->string('opname', 20)->default('')->comment('操作人');
            $table->timestamps();
            $table->softDeletes();
            $table->index('app_id');
            $table->index('cate_id');
            $table->index('api_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('requests');
    }
}
