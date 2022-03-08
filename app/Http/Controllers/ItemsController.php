<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\ItemCreateRequest;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('seller.item', compact('items'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('seller.item_create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemCreateRequest $request)
    {
        //dd($request->all());
        $item = new Item();
        $item->name = $request->name;
        $item->category_id = $request->category;
        $item->quantity = $request->quantity;
        $item->original_price = $request->original_price;
        $item->selling_price = $request->selling_price;
        
        
        $imageName = date('YmdHis'). "." . request()->item_image->getClientOriginalExtension();
        request()->item_image->move(public_path('images'), $imageName);

        $item->image = $imageName;
        $item->save();

        return redirect('item')->with('message', "Item created successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
       return view('seller.item_edit', compact('item','categories')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'category' => 'required',
            'quantity' => 'required',
            'original_price' => 'required',
            'selling_price' => 'required',
        ]);
        $item->name = $request->name;
        $item->category_id = $request->category;
        $item->quantity = $request->quantity;
        $item->original_price = $request->original_price;
        $item->selling_price = $request->selling_price;
        if ($request->item_image)
        {
            $imageName = date('YmdHis'). ".". request()->item_image->getClientOriginalExtension();
            request()->item_image->move(public_path('images'), $imageName);
            $item->image = $imageName;
        }

        $item->save();

        return redirect('item')->with('message','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect('item')->with('message','Item removed successfully');
    }


    public function order()
    {
        $rawstatus = config('res.order_status');
        $status = array_flip($rawstatus);
        $orders = Order::all();
        
        
        return view('seller.order', compact('orders','status'));
    }


    public function approve(Order $order)
    {
        $order->status = config('res.order_status.processing');

        $order->save();
        return redirect('order')->with('message','Order Approved');
    }

    public function cancel(Order $order)
    {
        $order->status = config('res.order_status.cancel');
        $order->save();
        return redirect('order')->with('message','Order Rejected');
    }

    public function ready(Order $order)
    {
        $order->status = config('res.order_status.ready');
        $order->save();
        return redirect('order')->with('message','Order Ready');
    }
}
