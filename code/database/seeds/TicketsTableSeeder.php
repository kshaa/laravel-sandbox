<?php

use App\Event;
use App\Ticket;
use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::truncate();
        for ($e = 1; $e <= 50; $e++) {
            $rows = rand(7, 30);
            // rows and seats will be now added to the events table
            $seats = rand(7, 40);
            $event=Event::find($e);
            $event->rows=$rows;
            $event->seats=$seats;
            $event->save();
            $price = rand(50, 200) / 10;
            for ($r = 1; $r <= $rows; $r++) {
                for ($s = 1; $s <= $seats; $s++) {
                    Ticket::create(array('event_id' => $e, 'row' => $r, 'seat' => $s, 'price' => $price - $r / 10));                    
                }
            }
        }
    }
}
