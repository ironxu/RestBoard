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
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
