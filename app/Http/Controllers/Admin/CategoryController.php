<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;

class CategoryController extends Controller
{
    public function index()
    {
        //with theo quan hệ User::with('categories') danh mục theo user
        $categories = Category::with('user')->orderBy('updated_at', 'asc')->get();
       // $categories = Category::get();
       //$user = User::find(1);
       //$user->categories // trả về 1 collention  categories() quyery buider
        //$user->categories->toArray()
        //dd($user->categories); mảng
        //dd($categpry->user->email);

        //dd($categories);
        // return User::get()->each(function (User $user){
        //     $user->categories;
        // });
       // dd($categories);
        // $user->categories->each(function($categories){  // 1000 bản ghi

        // });


        return view('admin.components.category.index',compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        if ($request->ajax()) {
            $category              = new Category();
            $category->parent_id   = $request->category_id;
            $category->name        = $request->name;
            $category->description = $request->description;
            $category->user_id     = 1;
           
            if($request->hasFile('file_data')) {
                $imageName = uploadImage($request->file_data,'images/category',[],false);
                if($imageName && $imageName['code']){
                    $fileNameUpload = $imageName['path_img'];
                }else{
                    return response()->json([
                        'status'  => false,
                        'message' => 'Có lỗi trong quán trình chọn file',
                    ], 200);
                }
                $category->icon_url   =  $fileNameUpload;
            }
          
            $category->save();
            $categories = Category::where('active',1)->get();

            return response()->json([
                'status'  => true,
                'data'    => $categories,
                'message' => 'Thêm mới thành công',
            ], 200);

        }
    }

    public function changePostion(Request $request)
    {
        if ($request->ajax()) {
            $this->updatePosition($request->list);
            $categories = Category::where('active',1)->get();

            return response()->json([
                'status'  => true,
                'data'    => $categories,
                'message' => 'Cập nhật vị trí thành công'
            ], 200);
        }
    }

    public function updatePosition($categories, $parent = 0, &$position = 0)
    {
        foreach($categories as $item) {
            $position++;
            $category             =  Category::findOrFail($item['id']);
            $category->parent_id  =  $parent;
            $category->position   =  $position;
            $category->save();
            if(array_key_exists("children", $item)) {
                $this->updatePosition($item['children'], $item['id'], $position);
            }
        }

        return true;
    }

    public function changeActive(Request $request)
    {
        if($request->ajax()) {
            $category = Category::findOrFail($request->id);
            if($category) {
                $active = ($category->status) ? 0 : 1;
                $category->status = $active;
                $category->save();

                return response()->json([
                    'status'  => true,
                    'message' => 'Cập nhật trạng thái thành công',
                ], 200);
            }
        }
    }

    public function show(Request $request)
    {
        if($request->ajax()) {
             try {
                $category = Category::findOrFail($request->id);

                return response()->json([
                    'status' => true,
                    'data' => $category,
                    'message' => '',
                ], 200);
            } catch (ModelNotFoundException $exception) {
                return response()->json([
                    'status' => false,
                    'message' => 'Không tìm thấy danh mục',
                ], 200);
            }
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            try {
                $category = Category::findOrFail($request->id);
                $category->description =  $request->description;
                $category->name        =  $request->name;
                $category->save();

                return response()->json([
                    'status' => true,
                    'data' =>  '',
                    'message' => 'Cập nhật thành công',
                ], 200);
            } catch (ModelNotFoundException $exception) {
                return response()->json([
                    'status' => false,
                    'message' => 'Không tìm thấy danh mục',
                ], 200);
            }
        }
    }

    public function destroy(Request $request)
    {
        if($request->ajax()) {
            try {
                $category = Category::findOrFail($request->id);
                $category->active = 0 ;
                $category->save();

                return response()->json([
                    'status' => true,
                    'data' =>  '',
                    'message' => 'Xóa thành công danh mục',
                ], 200);
            } catch (ModelNotFoundException $exception) {
                return response()->json([
                    'status' => false,
                    'message' => 'Không tìm thấy danh mục',
                ], 200);
            }
        }
    }

    public function importExcel()
    {
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function ($reader) {})->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $insert[] = ['title' => $value->title, 'description' => $value->description];
                }
                if (!empty($insert)) {
                    DB::table('items')->insert($insert);
                    dd('Insert Record successfully.');
                }
            }
        }

        return back();
    }

    public function downloadExcel($type, $data = '')
    {
        dowloadfile($type, Product::get()->toArray());
    }

    public function importExport()
    {
        return view('importExport');
    }
}
