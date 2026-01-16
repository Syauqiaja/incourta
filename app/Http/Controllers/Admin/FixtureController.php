<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FixtureService;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public function index()
    {
        $fixtureService = new FixtureService();
        $fixtures = $fixtureService->listTeamEventDummy();
        return view("admin.fixture.index", compact("fixtures"));
    }
}
