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

    // headers 转为字符串
    public static function headersToStr($headers)
    {
        $str = '';
        foreach ($headers as $headerKey => $headerValue) {
            $str .= $headerKey . ": ";
            $str .= implode(";", $headerValue);
            $str .= "\n";
        }

        return $str;
    }
}
