<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryPost;

class CategoryPostController extends Controller
{
       public function index()
    {
        $category_category_post = CategoryPost::where('active',1)->get();
        return view('admin.components.category_blog.index',compact('category_category_post'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $category_post              = new CategoryPost();
        $category_post->name        = $request->name;
        $category_post->description = $request->description;
        $category_post->save();

         return response()->json([
            'status' => true,
            'message' => 'Thêm mới thành công',
        ], 200);
    }

    public function show(Request $request)
    {
        if($request->ajax()) {
             try {
                $category_post = CategoryPost::findOrFail($request->id);

                return response()->json([
                    'status' => true,
                    'message' => '',
                ], 200);
            } catch (ModelNotFoundException $exception) {
                return response()->json([
                    'status' => false,
                    'message' => 'Không tìm thấy bài viết',
                ], 200);
            }
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            try {
                $category_post              = CategoryPost::findOrFail($request->id);
                $category_post->name        = $request->name;
                $category_post->description = $request->description;
                $category_post->save();

                return response()->json([
                    'status' => true,
                    'data' =>  '',
                    'message' => 'Cập nhật thành công',
                ], 200);
            } catch (ModelNotFoundException $exception) {
                return response()->json([
                    'status' => false,
                    'message' => 'Không tìm thấy bài viết',
                ], 200);
            }
        }
    }

    public function destroy(Request $request)
    {
        if($request->ajax()) {
            try {
                $category_post         = CategoryPost::findOrFail($request->id);
                $category_post->active = 0 ;
                $category_post->save();

                return response()->json([
                    'status' => true,
                    'data' =>  '',
                    'message' => 'Xóa thành công bài biết',
                ], 200);
            } catch (ModelNotFoundException $exception) {
                return response()->json([
                    'status' => false,
                    'message' => 'Không tìm thấy bài biết',
                ], 200);
            }
        }
    }

    public function changeActive(Request $request)
    {
        if($request->ajax()) {
            $category_post = CategoryPost::findOrFail($request->id);
            if($category_post) {
                $active                = ($category_post->status) ? 0: 1;
                $category_post->status = $active;
                $category_post->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Cập nhật trạng thái thành công',
                ], 200);
            }
        }
    }
}
