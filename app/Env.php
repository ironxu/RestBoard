<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Env extends Model
{
    // 软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = ['app_id', 'name', 'url', 'host', 'color', 'remark', 'opname'];
}
