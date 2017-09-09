<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Req extends Model
{
    // 软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = ['app_id', 'api_id', 'cate_id', 'env_id', 'name', 'description', 'method', 'uri', 'req_header', 'req_body', 'resp_header', 'resp_body', 'remark', 'opname'];

    protected $table = "requests";
}
