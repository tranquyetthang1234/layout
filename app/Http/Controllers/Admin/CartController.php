<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function addProduct(Request $request, $id)
    {
        $product = \Product::select('name,descript')->find($id);
        if(!$product) return redirect('/');

        \Cart::add([
            'id'      => $id,
            'name'    => $product->name,
            'qty'     => 1,
            'price'   => $product->price,
            'options' => ['avatar' => $product->avatar]
        ]);
    }

    public function getListShoppingCart()
    {
        $products = \Cart::content();
        //$data = $request->except('_token');
        // Contact::insert($data)
        //https://bootsnipp.com/snippets/ypqoW
        // php artisan make:migration alert_column_pro_pay_in_table_products
        return view('xxx');
    }

    public function deleteItemShoppingCart($id)
    {
        \Cart::remove($id);
        return redirec('xxx');
    }

    public function saveInfoShoppingCart(Request $request)
    {
        $total = str_replace(',','',\Cart::subtolal(0,3));
        $transactionId = Transaction::insertGetId([
            'tr_user_id' => 1,
            'tr_total'   => $total,
            'note'       => $request->note,
            'tr_address' => $request->address,
            'tr_phone'   => $request->phone
        ]);

        if($transactionId) {
            $products = \Cart::content();
            foreach ($products as $key => $product) {
                Order::insert([
                    'order_transction' => $transactionId,
                    'product_id'       => $product->id,
                    'qty'              => $product->transacqtytionId,
                    'price'            => $product->price,
                    'sale'             => $product->option->sale
                ]);
            }
        }
        \Cart::destroy();
        return redirect('xx');
    }

    public function viewOrder(Request $request,$id)
    {
        if($request->ajax()) {
            $orders = Order::where('or_transaction_id','$id')->get();
            $html = view('xxx',compact('orders'))->render();

            return \response($html);
        }
    }

    public function rating()
    {
        $ratings = Rating::with('user:id,name','product:id.pro_name')->paginate(10);
    }

    // class="orderby"
    //<a class="{{Request::get('prce') == 1 ? 'active' : '' }}" href="{{  request()->fullUrlWithQuery(['price'=>1]) }}"></a>
    //$transction->created_at->format('d/m/Y')
    public function getListProduct(Request $request)
    {
        $url = $request->segment(2);
        $url = preg_split('/(-)/i', $url);
        if($id = array_pop($url))
        {
            $products = Product::where([
                'category_id' => $id,
                'active'      => '1'
            ]);
        }
        if($request->price) {
            $price = $request->price;   // ul li
            switch ($price) {
                case '1':
                    $products->where('price','<',100000);
                    break;
                case '1':
                    $products->whereBetween('price',[10000,20000]);
                    break;
                default:
                    # code...
                    break;
            }
        }
        if($request->ordeby) {
            $orderby  =  $request->orderby ;
            switch ($orderby) {
                case 'asc':
                    $products->where('id','DESC');
                    break;
                case 'asc':
                    $products->where('price','<','ASC');
                    break;

                default:
                    # code...
                    break;
            }
        }
        $products = $products->orderBy('id','DESC')->paginate(15);
    }

    public function chart()
    {
        $sumDay = Transaction::whereDay('update_at',date('d'))->where('active',1)->sum('totle');

    }

    public function suggest() // san phẩm gợi ý đã mua
    {
        $transaction  = Transaction::where([
            'user_id' => 1,
            'status' => 1
        ])->pluck('id');

        if($transaction) {
            $listId = Order::whereIn('or_transaction',$transaction)->distinct->pluck('product_id');
            $listIdCategory = Product::whereIn('id_',$listId)->distinct->pluck('category_id');
            if($listIdCategory) {
                $productSuggest = Product::whereIn('pro_cat',$listIdCategory)->limit(6)->get();
            }
        }
    }

    public function saveChangePassword(RequestPassword $requestPassord)
    {
        if(\Hash::check($requestPassord->password_old, \Auth::user()->passowrd)) {
            $user = User::find(1);
            $user->password = $requestPassord->password;
            $user->save();
        }
        return redirect()->back();
        // php arisan make:migration alert_column_code_and_time_code_table_users
    }

    public function sendCodeRestPassword()
    {
        $email = $request->email;
        $checkUser = User::where('email', $email)->first();
        if(!$checkUser) {

        }
        $codee = bcrypt(md5(time().$email));
        $checkUser->code = $code;
        $checkUser->time = \Carbon::now();
        $checkUser->save();
        $url = route('xxx',['code'=>$code,'email' =>$email]);
        return redirect('');
    }

    public function resetPassword()
    {
        $code = $request->code;
        $email = $request->email;
        $checkUser = User::where([
            'code' => $code,
            'email' =>$email
        ]);
        if(!$checkUser) {
            return redirect('');
        }

    }


}
