<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\Category;
use App\User;

class BlogController extends Controller
{
   public function index(Post $post)
    {
        $posts = Post::with('categoryPost')->orderBy('updated_at', 'asc')->get();
        $category_blog = CategoryPost::where('active', 1)->get();
       // $categories = User::with('categories')->orderBy('updated_at', 'asc')->get();
        dd($posts->toArray());
        // $string = "phan";
        // $count  = 0 ;
        // $z = 0;
        // while (@$string[$count]) {
        //     $count++ ;
        // }
        // dd($posts->user());
        return view('admin.components.blog.index',compact('posts'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->save();

         return response()->json([
            'status' => true,
            'message' => 'Thêm mới thành công',
        ], 200);
    }

    public function show(Request $request)
    {
        if($request->ajax()) {
             try {
                $post = Post::findOrFail($request->id);

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
                $post = Post::findOrFail($request->id);
                $post->title = $request->title;
                $post->description = $request->description;
                $post->content = $request->content;
                $post->save();

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
                $post = Post::findOrFail($request->id);
                $post->active = 0 ;
                $post->save();

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
            $post = Post::findOrFail($request->id);
            if($post) {
                $active = ($post->status) ? 0 : 1;
                $post->status = $active;
                $post->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Cập nhật trạng thái thành công',
                ], 200);
            }
        }
    }

    public function postSend(Request $request)
    {

        $to                         =      $request->txtTo;
        $fullName                   =      $request->txtFullname;
        $txtSubject                 =      $request->txtSubject;
        $txtContent                 =      $request->txtContent;

        $valid = Validator::make($request->all(), [
            'txtTo'                             => 'required|email',
            'txtSubject'                        => 'required',
            'txtContent'                        => 'required'
        ], [
            'txtTo.required'                    => 'Bạn Chưa Nhập Vào Email Người Giửi',
            'txtSubject.required'               => 'Bạn Chưa Nhập Vào Tiêu Đề',
            'txtTo.email'                       => 'Email Không Đúng Định Dạng',
            'txtContent.required'               => 'Vui Lòng Nhập Nội Dung Cần Giửi'
        ]);

        if ($valid->fails()) {
            return redirect()->route('admin.mail.send')->withErrors($valid)->with('success', 'Please Input text Full !');
        } else {
            Mail::to($to)->send(new ContactSendMail($txtContent, $txtSubject, $fullName));

            return redirect()->route('admin.mail.send')->with('success', 'Send content to ' . $to . ' Mail Successful !');
        }
    }

    public function seachNew(Request $request){
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('querys');

            if($query != '')
            {
                $data = DB::table('news')
                    ->where('title', 'like', '%'.$query.'%')
                    ->orWhere('name', 'like', '%'.$query.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(10);

            }
            else
            {
                $data = DB::table('news')
                    ->orderBy('id', 'desc')
                    ->paginate(10);
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $output .= '
                <tr>
                <th>'.'10'.'</th>
                <th width="100px"><input style="width: 17px ;height: 17px" type="checkbox" class="check" name="checkbox[]" width="30px" height="30px"  value='.$row->id.'></th>
                <th><img width="60px" style="border: 1px solid #42b459" src="images/news/'.$row->title .'" alt=""> </th>
                <th style="color: green">'.$row->name.'</th>
                <th> '.$row->author.'</th>
                <th style="padding-left: 32px"><a href="'.route('admin.new.status',$row->id).'"  "> 1</a></th>
				 <th> '.$row->author.'</th>
				  <th> '.$row->author.'</th>
                </tr>
                ';
                }
            }
            else
            {
                $output = '
               <tr>
                <td align="center" colspan="7">No Data Found</td>
               </tr>
               ';
            }
            $data = array(
                'table_data'  => $output,
				'sum' =>$total_row

            );

            echo json_encode($data);
        }
		//onesignal
		//https://hackernoon.com/eloquent-relationships-cheat-sheet-5155498c209
    }

    public  function getEditNew($id){
        $name_tag = array();
        $new = News::where('id',$id)->first();
        if($new !== null){
            $tags = News_Tag::where('news_id',$id)->get();

            foreach ($tags as $value){
                $name_tag[] = Tags::where('id',$value->tags_id)->first();
            }

        }else{
            return redirect()->route('admin.new.list')->with('danger','News  No Exits ');
        }
        return view('admin.modules.news.edit',compact('new','name_tag'));
    }

}
