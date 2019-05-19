<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Ticket extends Model
{
    public function event() {
        return $this->belongsTo('App\Event');
    }

    /**
     * Create a new Eloquent Ticket Collection instance.
     *
     * @param  array  $models
     * @return TicketCollection
     */
    public function newCollection(array $models = [])
    {
        return new TicketCollection($models);
    }
}

class TicketCollection extends Collection
{
    /**
     * Get the price of all the tickets in a given collection
     */
    public function getPriceAll()
    {
        $total = 0.0;
        $tickets = $this->all();
        
        foreach ($tickets as $ticket) {
            $total += $ticket->price;                
        }

        return $total;
    }
}
