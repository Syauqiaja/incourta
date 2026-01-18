<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

use function Symfony\Component\Translation\t;

class EventRegistrationController extends Controller
{
    public function register(Request $request, $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        if(!$event){
            return redirect()->back()->with('error', 'Event not found.');
        }

        
    }
}
