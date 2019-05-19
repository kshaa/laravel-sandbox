<?php

namespace App\Http\Controllers;

use App\Event;
use App\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    // Middleware
    public function __construct()
    {
        // only Admins have access
        $this->middleware('admin');
    }    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ticket_create', array('events' => Event::orderBy('name')->pluck('name', 'id')));  
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $rules = $rules = array(
            'event' => 'required|exists:events,id',
            'row' => 'required|integer|min:0',
            'seat' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        );
        
        $this->validate($request, $rules);
        
        $ticket = new Ticket();
        $ticket->row = $data['row'];
        $ticket->seat = $data['seat'];
        $ticket->price = $data['price'];
        $ticket->event()->associate(Event::find($data['event']));
        $ticket->save();
        return redirect('admin')->with('message','Ticket added!');       
    }
}
