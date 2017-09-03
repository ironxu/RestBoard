<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Api extends Model
{
    // 软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    //
    protected $fillable = ['app_id', 'cate_id', 'name', 'description', 'method', 'domain', 'uri', 'req_header', 'req_body', 'resp_header', 'resp_body', 'remark', 'opname'];

    public static function formatJsonBody($body)
    {
        if (empty($body)) {
            return '';
        }

        $jsonBody = json_decode($body, true);
        if (!empty($jsonBody) && json_last_error() == JSON_ERROR_NONE ) {
            return json_encode($jsonBody, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        } else {
            return '';
        }
    }
}
