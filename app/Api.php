<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Api extends Model
{
    // 软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //
    protected $fillable = ['app_id', 'cate_id', 'name', 'description', 'method', 'domain', 'uri', 'req_header', 'req_body', 'resp_header', 'resp_body', 'remark', 'opname'];
}
