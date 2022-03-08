<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

    }

    public function index(){
        //return view('seller.order');
        $items = Item::orderBy('id' ,'desc')->get();
        return view('order_form', compact('items'));
    }

    public function submit(Request $request)
    {
        //dd(array_filter($request->all()));
        //dd(array_filter($request->except('_token')));
        //dd(array_filter($request->except('_token','customer')));
        $data = array_filter($request->except('_token','c_name','c_phone','c_address'));
        
        $customer_id = rand(1,10);
        $orderId = rand();

        $customer = new Customer();
        $customer->id = $customer_id;
        $customer->c_name =$request->c_name;
        $customer->c_phone =$request->c_phone;
        $customer->c_address =$request->c_address;

        $customer->save();
        
        foreach($data as $key => $value) {
           
            if($value > 1 ){
                
                for ($i=0; $i< $value; $i++){
                    echo ($request->$key);
                    
                    $order = new Order();
                    $order->order_id = $orderId;
                    $order->customer_id = $customer->id;
                    $order->item_id = $request->$key;
                    $order->status = config('res.order_status.new');

                    $order->save();
  
                }
            }
            else{
                $order = new Order();
                $order->order_id = $orderId;
                $order->customer_id = $customer->id;
                $order->item_id = $request->$key;
                $order->status = config('res.order_status.new');

                $order->save();
                }
        }
        return redirect('/')->with('message','Order Submitted');

    }

    public function orderList()
    {
        $rawstatus = config('res.order_status');
        $status = array_flip($rawstatus);
        $orders = Order::where('status',4)->get();
        //echo ($orders);

        $singles = DB::table('orders')
        ->select('customer_id', DB::raw('COUNT(*) as `count`'))
        ->where('status',4)
        ->groupBy('order_id', 'customer_id')
        ->having('count', '>=', 1)
        ->get();
        //echo ($singles);

        foreach ($singles as $single) {
            //echo ($single->customer_id);
           // $customer_detail = DB::table('customers')->where('id',$single->customer_id)->value('c_name');
            //echo($customer_detail);
            $customer_detail = DB::table('customers')->where('id',$single->customer_id)->get();
            //echo($customer_detail);

            $item_id = Order::select('item_id')->where('customer_id',$single->customer_id)->where('status',4)->value('item_id');
            //echo($item_id);

            $item_name = DB::table('items')->where('id',$item_id)->value('name');
            //echo($item_name);
            $item_selling_price= DB::table('items')->where('id',$item_id)->value('selling_price');
            //echo($item_selling_price);

            $all_order = Order::where('customer_id',$single->customer_id)->where('status',4)->get();
            //echo($all_order);

            return view('customer_selection', compact( 'customer_detail' ,'item_name', 'item_selling_price', 'all_order','status'));


        }
  
    
    }
    

}
