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

    protected $hidden = ['deleted_at'];
    
    // 格式化无限分类树
    public static function formatTree($arr, $pid, $path)
    {
        $tree = [];
        $path[] = $pid;

        foreach ($arr as $key => $cate) {
            if ($cate['pid'] == $pid) {
                $ret = static::formatTree($arr, $cate['id'], $path);
                $cate['path'] = $path;
                $cate['children'] = $ret;
                $tree[] = $cate;
            }
        }

        return $tree;
    }

    // 格式化无限分类树, 用于Tree
    public static function formatTreeForTree($arr, $pid)
    {
        $tree = [];

        foreach ($arr as $key => $cate) {
            if ($cate['pid'] == $pid) {
                $data = [];
                $data['id'] = $cate['id'];
                $data['label'] = $cate['name'];

                $ret = static::formatTreeForTree($arr, $cate['id']);
                if (!empty($ret)) {
                    $data['children'] = $ret;
                }

                $tree[] = $data;
            }
        }

        return $tree;
    }

    // 格式化无限分类树, 用于Cascader
    public static function formatTreeForCascader($arr, $pid)
    {
        $tree = [];

        foreach ($arr as $key => $cate) {
            if ($cate['pid'] == $pid) {
                $data = [];
                $data['id'] = $cate['id'];
                $data['value'] = $cate['id'];
                $data['label'] = $cate['name'];

                $ret = static::formatTreeForCascader($arr, $cate['id']);
                if (!empty($ret)) {
                    $data['children'] = $ret;
                }

                $tree[] = $data;
            }
        }

        return $tree;
    }

    // 格式化无限分类树
    public static function formatForPath($arr, $id, $path = [])
    {
        array_unshift($path, $arr[$id]['pid']);

        if ($arr[$id]['pid'] != 0) {
            $path = static::formatForPath($arr, $arr[$id]['pid'], $path);
        }

        return $path;
    }
}
