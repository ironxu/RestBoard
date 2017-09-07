<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Api;
use App\Req;

class RequestController extends Controller
{
    /**
     * 根据API 获取最新一条request，如果没有request，就根据API 创建并返回
     * POST requests/api/{app_id}
     * @param  int $apiid api id
     * @return array        request id
     */
    public function api($apiid)
    {
        $lastRequest = Req::where('api_id', $apiid)
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get()->toArray();

        // 检查是否已经有request，如果有数据就返回当前
        if (!empty($lastRequest)) {
            $req = current($lastRequest);
            return response(['id' => $req['id']]);
        } else {
            // 如果当前api 没有request，就根据api 创建一条
            $api = Api::find($apiid);
            if (empty($api)) {
                $data = [
                    'message' => 'api 不存在, 请刷新页面后重试',
                    'doc_url' => request()->root() . '/help/errors/404',
                ];
                return response($data, 404);
            }

            $data = $api->toArray();
            $req = new Req($data);
            
            $req->api_id = $data['id'];
            $req->opname = 'admin';

            $data = [];
            if ($req->save()) {
                $data = ['id' => $req->id];
            }

            return $data;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($apiid)
    {
        $data = Req::where('api_id', $apiid)->get()->toArray();

        if (empty($data)) {
            $data = [
                'message' => '该分类下没有request 信息, 请先添加',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     * POST requests
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = new Req($request->all());
        $req->opname = 'admin';

        $data = [];
        if ($req->save()) {
            $data = ['id' => $req->id];
        }

        return $data;
    }

    /**
     * Display the specified resource.
     * GET requests/{id}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Req::find($id);

        if (!$data) {
            $data = [
                'message' => 'request 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }

        $resp_body = $data->resp_body;
        $data['resp_body_json'] = Api::formatJsonBody($resp_body);

        return $data;
    }

    /**
     * Update the specified resource in storage.
     * PUT requests/{id}
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $req = Req::find($id);

        if (!$req) {
            $data = [
                'message' => 'request 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }

        $ret = $req->update($request->all());

        if ($ret) {
            return $req;
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
     * DELETE /requests/{id}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $req = Req::find($id);

        if (!$req) {
            $data = [
                'message' => 'request 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }

        if ($req->delete()) {
            $data = ['id' => $id];
        }
        return $data;
    }
}
