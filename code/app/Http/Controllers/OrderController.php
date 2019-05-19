<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Order;
use App\Ticket;
use App\TicketOrder;
use Auth;

class OrderController extends Controller
{
    // Middleware
    public function __construct() {
        // only authenticated users have access
        $this->middleware('auth');
        // easy error passing to view
        $this->middleware('web');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listing(Request $request)
    {
        $userId = Auth::user()->id;
        $orders = Order::where('user_id', $userId)->get();

        return view('orders', [ 'title' => 'Orders', 'orders' => $orders ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $viewParams = [
            'title' => "Order #" . $id . " details",
            'order' => $order,
            'total' => $order->getTotal()
        ];

        return view('order_show', $viewParams);
    }

    public function create(Request $request)
    {
        $ticketIds = array_keys($request->session()->get('cart', array()));
        if (count($ticketIds) == 0) {
            return redirect()
                ->action('OrderController@listing')
                ->withMessage('Can\'t place order without tickets!');
        }

        $tickets = Ticket::whereIn('id', $ticketIds)->get();        
        $viewParams = [
            'title' => "Place order",
            'total' => $tickets->getPriceAll(),
            'tickets' => $tickets
        ];

        return view('order_create', $viewParams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Parse request
        $data = $request->all();

        // Setup & validate order
        $order = new Order();
        $order['phone_number'] = $data['phone_number'];
        $order['shipping_address'] = $data['shipping_address'];
        $order['user_id'] = Auth::user()->id;
        $validation = $order->validate();
        if (!$validation->passes()) {
            return redirect()
                ->action('OrderController@create')
                ->withErrors($validation->errors()->all());
        }

        $ticketOrderId = null;
        
        // Store order and ticket orders in a single transaction
        DB::transaction(function() use($order, $data, &$ticketOrderId)
        {
            // Store order models
            $order->save();
            $ticketOrderId = $order->id;

            // Store ticketOrder models
            $ticketIds = $data['ticket_ids'];
            foreach ($ticketIds as $ticketId) {
                $ticketOrder = new TicketOrder();
                $ticketOrder['order_id'] = $ticketOrderId;
                $ticketOrder['ticket_id'] = $ticketId;
                $ticketOrder->save();
            }
        });

        // Something went wrong
        if ($ticketOrderId == null) {
            return redirect()
                ->action('OrderController@create')
                ->withErrors(["Something went wrong"]);
        }

        // Flush cart
        $request->session()->put('cart', []);
        
        // Redirect to new successful order details page
        return redirect()
            ->action('OrderController@details', array($ticketOrderId))
            ->withMessage('Successfully placed order!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request, $id)
    {
        $current_cart = $request->session()->get('cart', array());
        
        var_dump($current_cart);

        return "Remove #" . $id;
        // // if not already in the shopping car, add
        // if (!array_key_exists($id, $current_cart))
        // {
        //     $request->session()->put('cart.'.$id, 1);
        // }

        // $current_cart = $request->session()->set('cart', array());
        
        // return redirect('cart');
    }
}
