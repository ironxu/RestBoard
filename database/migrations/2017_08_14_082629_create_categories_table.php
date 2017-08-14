<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('app_id')->comment('应用ID');
            $table->string('name', 50)->default('')->comment('分类名称');
            $table->unsignedInteger('pid')->comment('上级ID');
            $table->unsignedInteger('sort')->comment('排序值，数值越大越靠前');
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
        Schema::drop('categories');
    }
}
