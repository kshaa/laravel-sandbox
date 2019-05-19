<?php
namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
class CartController extends Controller
{
    public function index(Request $request)
    {
        $total = 0.0;
        $display_result = array();
        
        $current_cart =  $request->session()->get('cart', array());
        
        foreach ($current_cart as $id => $count)
        {
            if ($count > 0)
            {
                $ticket = Ticket::findOrFail($id);
                $total += $ticket->price;                
                $display_result[] = $ticket;
            }
        }
        
        return view('cart_show', array('total' => $total, 'tickets' => $display_result));
    }    
    
    public function add(Request $request, $id)
    {
        $current_cart = $request->session()->get('cart', array());
        
        // if not already in the shopping car, add
        if (!array_key_exists($id, $current_cart))
        {
            $request->session()->put('cart.'.$id, 1);
        }
        
        return redirect('cart');
    }
    
    public function remove(Request $request, $id)
    {
        $current_cart = $request->session()->get('cart', array());
        
        // if in the shopping cart, remove
        if (array_key_exists($id, $current_cart))
        {
            if ($current_cart[$id] > 0)
            {
                $request->session()->put('cart.'.$id, 0);
            }
        }
        
        return redirect('cart');
    }
}