<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Api;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET apis?app_id={app_id}&cate_id={cate_id}
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $app_id = $request->input('app_id');
        $cate_id = $request->input('cate_id');
        $data = Api::where(['cate_id' => $cate_id, 'app_id' => $app_id])->get()->toArray();

        if (empty($data)) {
            $data = [
                'message' => '该分类下没有api信息, 请先添加',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $api = new Api($request->all());
        $api->opname = 'admin';

        $data = [];
        if ($api->save()) {
            $data = ['id' => $api->id];
        }

        return $data;
    }

    /**
     * Display the specified resource.
     * GET apis/{id}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Api::find($id);
        $resp_body = $data->resp_body;
        $data['resp_body_json'] = Api::formatJsonBody($resp_body);

        if (!$data) {
            $data = [
                'message' => 'app 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }
        return $data;
    }

    /**
     * Update the specified resource in storage.
     * PUT /apis/{id}
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $api = Api::find($id);

        if (!$api) {
            $data = [
                'message' => 'app 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }

        $ret = $api->update($request->all());

        if ($ret) {
            return $api;
        } else {
            $data = [
                'message' => '更新失败，请稍后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 202);
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /apis/{id}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $api = Api::find($id);

        if (!$api) {
            $data = [
                'message' => 'app 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }

        if ($api->delete()) {
            $data = ['id' => $id];
        }
        return $data;
    }
}
