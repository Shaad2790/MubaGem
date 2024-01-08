<?php


namespace App\Http\Controllers;
use App\Models\Cart;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Models\Users;


use App\Models\Product;

use App\Models\Order;


class HomeController extends Controller
{


    public function i(){
        return view('user.login');
    }
    
    
    public function redirect(){
        $username=Auth::user()->username;

        if($username=='1')
        {
            return view('admin.home');
        }
        else
        {
            $data = product::paginate(3);

            $user=auth()->user();

            $count=cart::where('phone',$user->phone)->count();
            
            return view('user.home',compact('data', 'count'));
        }
    }


    public function index()
    {

        $data = product::paginate(3);

        return view('user.home',compact('data'));
    }


    public function search(Request $request)
    {

        $search=$request->search;

        if($search=='')
        {
            $data = product::paginate(3);

        return view('user.home',compact('data'));
        }

        $data=product::where('title','Like','%'.$search.'%')->get();

        return view('user.home',compact('data'));
    }

    public function addcart(Request $request, $id)
    {

        if(Auth::id())
        {

            $user=auth()->user();

            $product=product::find($id);

            $cart=new cart;

            $cart->name=$user->name;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->product_title=$product->title;
            $cart->price=$product->price;

            $cart->save();

                
            return redirect()->back()->with('messege','Product Added Successfully');

        }

        else

        {

            return redirect('login');
            
        }


    }


    public function showcart()
    {

        $user=auth()->user();

        $cart=cart::where('phone',$user->phone)->get(); 

            $count=cart::where('phone',$user->phone)->count();

        return view('user.showcart',compact('count','cart'));

   
    }

    public function deletecart($id)
    {

        $data=cart::find($id);
        $data->delete();

        return redirect()->back()->with('messege','Item Removed From Cart Successfully');

    }

    public function confirmorder(Request $request)
    {

        $user=auth()->user();
        $name=$user->name;
        $phone=$user->phone;
        $address=$user->address;


        foreach($request->itemname as $key=>$itemname)
        {
            $order=new order;
            
            $order->item_name=$request->itemname[$key];
            $order->price=$request->price[$key];
            $order->name=$name;
            $order->phone=$phone;
            $order->address=$address;
            $order->status='not delivered';

            $order->save();
           

        }

        DB::table('carts')->where('phone',$phone)->delete();
        return redirect()->back()->with('messege','Product Ordered Successfully');

    }
}
