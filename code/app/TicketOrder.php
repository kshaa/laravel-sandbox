<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketOrder extends Model
{
    public function ticket() {
        return $this->belongsTo('App\Ticket');
    }

    public function order() {
        return $this->belongsTo('App\Order');
    }
}
