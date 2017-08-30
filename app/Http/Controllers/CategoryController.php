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
    public function index(Request $request, $appid)
    {
        $data = Category::where('app_id', $appid)->get(['id', 'name', 'pid'])->toArray();

        if (empty($data)) {
            $data = [
                'message' => 'app 没有分类信息, 请先添加',
                'doc_url' => request()->root() . '/help/errors/404',
            ];
            return response($data, 404);
        }

        if ($request->input('type') == 'tree') {
            return Category::formatTreeForTree($data, 0);
        } elseif ($request->input('type') == 'cascader') {
            return Category::formatTreeForCascader($data, 0);
        } else {
            return Category::formatTree($data, 0, []);
        }
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

        $app_id = $category['app_id'];
        $allCategories = Category::where('app_id', $app_id)->get(['id', 'name', 'pid'])->toArray();
        
        $allCategories = array_column($allCategories, null, 'id');
        $path = Category::formatForPath($allCategories, $id);
        $category['path'] = $path;

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
