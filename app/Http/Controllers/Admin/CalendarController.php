<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Container\Container;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use App\Tool\Facades\Tool;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function test(Request $request)
    {
        dd(Tool::time_elapsed_string_2(date('d-m-Y')));
        /**
         * $request ==  $appRequest true so sánh id
         * Service Provider đăng kí các thư viện vào trong ứng dụng
         * Quản lí các thư viện dựa vào service container
         */
        $appRequest = app('request');  //
        $container = Container::getInstance();
        //$service = $container->get(UserService::class);
        dd($container);
    }
    public function index()
    {
        $idCountry = [1566083,1581130];

        foreach ($idCountry as $key => $id) {
            $this->getApiWeather($id);
        }
        dd('thành công');
         return view('admin.components.calendar.index');
    }

    public function getApiWeather($id)
    {
        $response = Curl::to("http://api.openweathermap.org/data/2.5/weather?id=$id&units=metric&appid=af8052475ccdac2846dfe4106b35d4b1&lang=vi")->get();

        $data           =       json_decode($response,true);
        $date           =       date('H:i:s d-m-y',$data['dt']);
        $content        =       ucfirst($data['weather'][0]['description']);
        $icon           =       'http://openweathermap.org/img/wn/'.$data['weather'][0]['icon'].'@2x.png';
        $main           =       $data['weather'][0]['main']; // dông
        $temperature    =       $data['main']['temp'].' độ C'; // nhiejt dộ
        $humidity       =       $data['main']['humidity'].' %'; // độ ẩn
        $wind           =       $data['wind']['speed'].' m/s'; // gió
        $clouds         =       $data['clouds']['all'].' %'; // mây
        $country        =       $data['name']; // country

        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        $token = "823778813:AAEDh-diH6_gYalTG1yyO3SCxbKLFmR2Df8";

        $datas = [
            'text' => 'Dự báo thời tiết'.PHP_EOL.
            'Ngày : '.'*'.$date.'*'.PHP_EOL.
            'Thành phố : '.'*'.$country.'*'.PHP_EOL.
            'Trạng thái : '.'*'.$main.'*'.PHP_EOL.
            'Nhiệt độ  : '.'*'.$temperature.'*'.PHP_EOL.
            'Độ ẩm  : '.'*'.$clouds.'*'.PHP_EOL.
            'Gió  : '.'*'.$wind.'*'.PHP_EOL.
            'Mây  : '.'*'.$clouds.'*'.PHP_EOL.
            'Mô tả : '.'*'.$content.'*'.PHP_EOL.
            'Icon '.$icon.PHP_EOL,
            'chat_id' => '@weatherqthang',
            "parse_mode" => "Markdown",
        ];

         file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($datas), false, $context);
    }

    public function test2()
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                Attachment::create([
                    'type' => 'image',
                    'mime' => $file->getMimeType(),
                    'path' => $this->saveImage($file),
                    'product_id' => $product->id
                ]);
            }
        }
        //            Thêm Tags
        if ($request->has('tags') && is_array($request->input('tags')) && count($request->input('tags')) > 0) {
            $tags = $request->input('tags');
            $tagsID = [];
            foreach ($tags as $tag) {
                $tag = Tag::firstOrCreate([
                    'name' => str_slug($tag)
                ], [
                    'name' => str_slug($tag),
                    'slug' => str_slug($tag)
                ]);
                $tagsID[] = $tag->id;
            }
            $product->tags()->sync($tagsID);
        }
    }

    public function makeCategories($categories) {
        $newArr = [];
        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $newArr[$category->parent][] = $category;
            }
        }
        return $newArr;
    }


    public function getProduct(){
    	$shop = Shop::find(2);
    	$name  = ['teo','ti'];
    	$productID= [];
    	foreach ($name as $key => $value) {
    		$product = new Product();
    		$product->name = $value;
    		$product->save();
    		$productID[] = $product->id;
    	}
		$shop->products()->sync($productID);
		dd(1123);
    }
    public function detail($id){

		$artcle = \App\Article::where('id',$id)->first();
		event(new ViewProducts($artcle));
		return view('details',compact('artcle'));
	}
}
