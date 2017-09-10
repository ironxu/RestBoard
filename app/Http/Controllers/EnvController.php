<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Env;

class EnvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $appid)
    {
        if ($request->input('type', '') == 'cascader') {
            $data = Env::where('app_id', $appid)->get(['id', 'name'])->toArray();
        } else {
            $data = Env::where('app_id', $appid)->get()->toArray();
        }

        if (empty($data)) {
            $data = [
                'message' => 'app 没有环境信息, 请先添加',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     * POST /envs
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $env = new Env($request->all());
        $env->opname = 'admin';

        $data = [];
        if ($env->save()) {
            $data = ['id' => $env->id];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     * GET /envs/{id}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];

        $app = Env::find($id);
        if (!$app) {
            $data = [
                'message' => 'app 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }

        return $app;
    }

    /**
     * Update the specified resource in storage.
     * PUT /envs/{id}
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $env = Env::find($id);
        if (!$env) {
            $data = [
                'message' => 'app 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }
        
        $ret = $env->update($request->all());
        if ($ret) {
            return $env;
        } else {
            $data = [
                'message' => '更新失败，请稍后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($app, 202);
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /envs/{id}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [];

        $env = Env::find($id);
        if (!$env) {
            $data = [
                'message' => 'app 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }

        if ($env->delete()) {
            $data = ['id' => $id];
        }
        return $data;
    }
}
