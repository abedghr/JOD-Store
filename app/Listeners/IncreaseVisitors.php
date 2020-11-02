<?php

namespace App\Listeners;

use App\Events\VendorProfileVisitor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseVisitors
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */

    public function handle(VendorProfileVisitor $event)
    {
        $this->UpdateVisitors($event->vindor);
    }
    public function UpdateVisitors($v){
        $v->visitors +=1;
        $v->save();
    }
    
    
}
