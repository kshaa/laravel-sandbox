<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TicketOrder;
use Validator;

class Order extends Model
{
    private $rules = array(
        # Min/Max number digits - https://www.oreilly.com/library/view/regular-expressions-cookbook/9781449327453/ch04s03.html
        'phone_number' => 'required|integer|digits_between:6,14',
        'shipping_address' => 'required|string|min:1',
        'user_id' => 'required|integer'
    );        

    public function userId() {
        return $this->belongsTo('App\User');
    }

    public function ticketOrders() {
        return $this->hasMany('App\TicketOrder');
    }

    public function getTotal() {
        $total = 0.0;
        $ticketOrders = $this->ticketOrders;
        
        foreach ($ticketOrders as $ticketOrder) {
            $total += $ticketOrder->ticket->price;                
        }

        return $total;
    }

    /**
     * Validate order data
     * 
     * @returns Validator
     */
    public function validate($orderData = null) {
        // If no data - validate instance attributes
        if ($orderData == null) {
            $orderData = $this->getAttributes();
        }

        $validator = Validator::make($orderData, $this->rules);

        return $validator;
    }
}
