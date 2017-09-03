<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class App extends Model
{
    // 软删除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];
    
    //
    protected $fillable = ['name', 'description', 'remark', 'opname'];
}
