<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        return view('player.profile', compact('user'));
    }
}
