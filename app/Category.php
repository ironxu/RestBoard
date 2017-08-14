<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // 软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //
    protected $fillable = ['app_id', 'name', 'pid', 'sort', 'remark', 'opname'];

    // 格式化无限分类树
    public static function formatTree($arr, $pid, $path)
    {
        $tree = [];
        $path[] = $pid;

        foreach ($arr as $key => $cate) {
            if ($cate['pid'] == $pid) {
                $ret = static::formatTree($arr, $cate['id'], $path);
                $cate['path'] = $path;
                $cate['child'] = $ret;
                $tree[] = $cate;
            }
        }

        return $tree;
    }
}
