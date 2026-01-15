<?php

namespace App\Http\Controllers\Admin\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        return view('admin.events.index');
    }
    public function create(){
        return view('admin.events.create');
    }
    public function store(){}
    public function show(){
        return view('admin.events.detail');
    }
    public function update(){}
    public function delete(){}
}
