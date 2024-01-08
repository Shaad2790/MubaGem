<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use  App\Models\product;

use  App\Models\Order;

class AdminController extends Controller
{
    public function product()
    {
        return view('admin.product');
    }

    public function uploadproduct(request $request)
    {
        $data=new product;

        $image=$request->image;

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('productimage', $imagename);


        $data ->type=$imagename;


        $data->title=$request->title;
        $data->price=$request->price;
        $data->carat=$request->carat;
        $data->description=$request->des;

        $data->save();

        return redirect()->back()->with('messege','Product Added Successfully');
    }


    public function showproduct()
    {

        $data=product::all();

        return view('admin.showproduct',compact('data'));
    }


    public function deleteproduct($id)
    {

        $data=product::find($id);
        $data->delete();
        return redirect()->back()->with('messege','Product Deleted ');
    
    }

    public function updateview($id)
    {

        $data=product::find($id);

        return view('admin.updateview',compact('data'));
    }

    public function updateproduct(Request $request, $id)
    {

        $data=product::find($id);
        
        $data=new product;

        $image=$request->image;

        if($image)

        {

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('productimage', $imagename);

        $data ->type=$imagename;

        }

        $data->title=$request->title;
        $data->price=$request->price;
        $data->carat=$request->carat;
        $data->description=$request->des;

        $data->save();

        return redirect()->back()->with('messege','Product Updated Successfully');
    }


    public function search(Request $request)
    {
        $search=$request->search;

        $data=product::where('titlr', 'Like','%'.$search.'%')->get();

        return view('user.home', compact('data'));
    }


    public function showorder()
    {
        $order=order::all();

        return view('admin.showorder',compact('order'));

    }


    public function updatestatus($id)
    {

        $order=order::find($id);
        $order->status='delivered';
        $order->save();

        return redirect()->back();

    }

}
