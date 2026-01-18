<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function show($slug)
    {
        $event = Event::with(['pricings', 'creator'])->where('slug', $slug)->firstOrFail();
        return view('events.event-detail', compact('event'));
    }

    public function register($slug)
    {
        if(Auth::user()->player == null) {
            return redirect()->route('player.profile')->with('error', 'Please complete your player profile before registering for an event.');
        }

        $event = Event::with(['pricings', 'creator'])->where('slug', $slug)->firstOrFail();
        return view('events.event-registration', compact('event'));
    }
}
