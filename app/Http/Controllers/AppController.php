<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\App;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /apps
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return App::all();
    }

    /**
     * Store a newly created resource in storage.
     * POST /apps
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $app = new App($request->all());
        $app->opname = 'admin';

        $data = [];
        if ($app->save()) {
            $data = ['id' => $app->id];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     * GET /apps/{id}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];

        $app = App::find($id);
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
     * PUT /apps/{id}
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $app = App::find($id);
        if (!$app) {
            $data = [
                'message' => 'app 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }
        
        $ret = $app->update($request->all());
        if ($ret) {
            return $app;
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
     * DELETE /apps/{id}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [];

        $app = App::find($id);
        if (!$app) {
            $data = [
                'message' => 'app 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }

        if ($app->delete()) {
            $data = ['id' => $id];
        }
        return $data;
    }
}
