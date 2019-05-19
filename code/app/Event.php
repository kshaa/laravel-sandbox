<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    public function category() {
        return $this->belongsTo('App\Category');
    }
    
    public function tickets() {
        return $this->hasMany('App\Ticket');
    }
    
    public function formatTime() {
        return Carbon::createFromFormat('Y-m-d H:i:s',$this->start_time)->format('d-m-Y H:i');       
    }
}
