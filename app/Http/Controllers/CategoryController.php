<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /categories/app/{appid}
     * @return \Illuminate\Http\Response
     */
    public function index($appid)
    {
        $data = Category::where('app_id', $appid)->get()->toArray();

        if (empty($data)) {
            $data = [
                'message' => 'app 没有环境信息, 请先添加',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }
        return Category::formatTree($data, 0, []);
    }

    /**
     * Store a newly created resource in storage.
     * POST /categories
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category($request->all());
        $category->opname = 'admin';

        $data = [];
        if ($category->save()) {
            $data = ['id' => $category->id];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];

        $category = Category::find($id);
        if (!$category) {
            $data = [
                'message' => 'app 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }
        return $category;
    }

    /**
     * Update the specified resource in storage.
     * PUT /categories/{id}
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            $data = [
                'message' => 'app 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }

        $ret = $category->update($request->all());

        if ($ret) {
            return $category;
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
     * DELETE /categories/{id}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            $data = [
                'message' => 'app 不存在, 请刷新页面后重试',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }

        if ($category->delete()) {
            $data = ['id' => $id];
        }
        return $data;
    }
}
