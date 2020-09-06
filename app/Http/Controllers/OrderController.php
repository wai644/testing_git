<?php

// namespace App\Http\Controllers;

// use App\Order;
// use App\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// namespace App\Http\Controllers;

// use App\Order;
// use App\Brand;
// use App\Subcategory;
// use App\Item;
// use Carbon\Carbon;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class OrderController extends Controller
// {
//     public function __construct($value='')
//     {
//         $this->middleware('role:Admin')->only('index','show');
//         $this->middleware('role:Customer')->only('store');
//     }

//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//          $orders =Order::all();
//         // dd($orders);
//         return  view('backend.orders.index',compact('orders'));
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         // return 'Orders create from here!';
//         $users=User::all();
//         return view('backend.orders.create',compact('users'));
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
        
//         //dd($request->notes);
//         $cartArr = json_decode($request->shop_data);
//         $total = 0 ;
//         foreach ($cartArr as $row){
//             $total+=($row->price * $row->qty);
//         }

//         $order = new Order;
//         $order->voucherno = uniqid();
//         $order->orderdate = date('Y-m-d');
//         $order->user_id =Auth::id();
//         $order->note = $request->notes;
//         $order->total = $total;
//         $order->save();

//         foreach ($cartArr as $row) {
//             $order->items()->attach($row->id,['qty'=>$row->qty]);
//         }

//         return 'successfully';

//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  \App\Order  $order
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id)
//     {
//         //dd($id);
//         // $order=Order::find($id);
//         // return view('backend.orders.show',compact('order'));
//         // return view('backend.orders.show',compact('order'));
//         return view('backend.orders.show',compact('order'));
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  \App\Order  $order
//      * @return \Illuminate\Http\Response
//      */
//     public function edit(Order $order)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \App\Order  $order
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, Order $order)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  \App\Order  $order
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy(Order $order)
//     {
//         //
//     }
// }



namespace App\Http\Controllers;

use App\Order;
use App\Brand;
use App\Subcategory;
use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct($value='')
    {
        $this->middleware('role:Admin')->only('index','show');
        $this->middleware('role:Customer')->only('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date1 = $request->sdate;
        $date2 = $request->edate;

        if ($request->sdate && $request->edate) {
            $orders = Order::whereBetween('orderdate', [new Carbon($date1), new Carbon($date2)])->where('status',0)->get();
        }else{
            $orders = Order::all();
        }

    
        
        // dd($items);
       return view('backend.orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //dd($request->notes);
        $cartArr=json_decode($request->shop_data);//arr
        
        $total=0;
        foreach ($cartArr as $row) {
           $total+=($row->price * $row->qty);
        }
        $order=new Order;
        $order->voucherno=uniqid();//6789990
        $order->orderdate=date('Y-m-d');
        $order->user_id=Auth::id();//auth id(1 =users table)
        $order->note=$request->notes;
        $order->total=$total;
        $order->save();//only saved into order table

        //save into order_detail
        foreach ($cartArr as $row) {
            $order->items()->attach($row->id,['qty'=>$row->qty]);
        }
        return 'Successful!';

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        
        
                return view('backend.orders.show',compact('order'));
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

