<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use App\Http\Requests;
use App\Env;
use App\Category;
use App\Api;
use App\Req;

class RequestController extends Controller
{
    /**
     * request 请求
     * POST requests/request/{id}
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function request(Request $request, $id)
    {
        // 获取环境信息
        $envID = $request->input('env_id', 0);
        $envInfo = [];
        if ($envID) {
            $envInfo = Env::find($envID);
        }

        $method = $request->input('method', 'GET');
        if (!$method || !in_array($method, ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'])) {
            $data = ['message' => 'http 请求方式参数错误'];
            return response($data);
        }

        $uri = $request->input('uri', '');

        $reqBody = $request->input('req_body', '');

        $respHeaderStr = '';
        $respBody = '';
        $respBodyJson = '';
        $isJson = 0;
        // 如果环境id 存在，就取环境id 相关参数
        if ($envInfo) {
            // 链接补充http
            $baseUrl = $envInfo->url;
            if (strpos($baseUrl, 'http') !== 0) {
                $baseUrl = "http://" . $baseUrl;
            }

            // host 去掉http
            $host = $envInfo->host;
            if (strpos($host, 'http') === 0) {
                $host = parse_url($host, PHP_URL_HOST);
            }
            
            // 发送请求
            $client = new Client([
                'base_uri' => $baseUrl,
                'timeout' => 30.0
            ]);

            $options = [
                // 'debug' => true,
                'headers' => [
                    'HOST' => $host,
                ],
                'body' => $reqBody,
            ];

            $response = $client->request($method, $uri, $options);

            $respHeader = $response->getHeaders();
            $respHeaderStr = Req::headersToStr($respHeader);

            $respBody = trim((string)$response->getBody());
            if (in_array('application/json', $respHeader['Content-Type'])) {
                $respBodyJson = Api::formatJsonBody($respBody);
                if ($respBodyJson) {
                    $isJson = 1;
                }
            }
        } else {
            // 如果环境id 不存在，判断url 路径是否完整
            // 如果完整则执行请求
            if (strpos($uri, 'http') === 0) {
                // 发送请求
                $client = new Client([
                    'timeout' => 30.0
                ]);

                $options = [
                    // 'debug' => true,
                    'headers' => [
                        // 'HOST' => $host,
                    ],
                    'body' => $reqBody,
                ];

                $response = $client->request($method, $uri, $options);

                $respHeader = $response->getHeaders();
                $respHeaderStr = Req::headersToStr($respHeader);

                $respBody = trim((string)$response->getBody());
                if (in_array('application/json', $respHeader['Content-Type'])) {
                    $respBodyJson = Api::formatJsonBody($respBody);
                    if ($respBodyJson) {
                        $isJson = 1;
                    }
                }
            } else {
                // 如果不完整则抛出提示
                $data = ['message' => 'uri 参数错误, 请选择请求环境或者填写完整路径'];
                return response($data);
            }
        }

        return response([
            'resp_header' => $respHeaderStr,
            'resp_body' => $respBody,
            'resp_body_json' => $respBodyJson,
            'is_json' => $isJson,
         ]);
    }

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
            return response($req);
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
                $data = $req;
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
