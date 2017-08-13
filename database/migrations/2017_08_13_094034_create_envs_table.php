<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('app_id')->comment('应用ID');
            $table->string('name', 50)->default('')->comment('环境名称');
            $table->string('url', 200)->default('')->comment('环境地址');
            $table->string('host', 100)->default('')->comment('环境HOST');
            $table->char('color', 7)->default('')->comment('环境标识颜色');
            $table->string('remark', 200)->default('')->comment('备注');
            $table->string('opname', 20)->default('')->comment('操作人');
            $table->timestamps();
            $table->softDeletes();
            $table->index('app_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('envs');
    }
}
