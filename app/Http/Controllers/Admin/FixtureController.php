<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Fixture;
use App\Services\FixtureService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FixtureController extends Controller
{
    public function __construct() {}
    public function index($id)
    {
        $event = Event::find($id);
        return view("admin.fixture.index", compact("event"));
    }

    public function generate($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $event = Event::findOrFail($id);
            Fixture::where("event_id", $event->id)->delete();
            $fixtureService = new FixtureService();
            $fixtureService->generate($event);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Generate Fixture Success',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
