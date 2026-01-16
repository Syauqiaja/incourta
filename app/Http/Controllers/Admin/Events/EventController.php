<?php

namespace App\Http\Controllers\Admin\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventPricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index(){
        return view('admin.events.index');
    }
    
    public function create(){
        return view('admin.events.create');
    }
    
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string',
            'type' => 'required|string',
            'status' => 'required|string',
            'max_teams' => 'required|integer|min:2',
            'max_groups' => 'nullable|required_if:type,league|integer|min:2',
            'max_teams_in_group' => 'nullable|required_if:type,league|integer|min:2',
            'description' => 'nullable|string',
            'event_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'registration_deadline' => 'nullable|date|before:start_date',
            'prize_pool' => 'nullable|string|max:255',
            'pricing_name.*' => 'nullable|string|max:255',
            'pricing_price.*' => 'nullable|numeric|min:0',
            'pricing_start_date.*' => 'nullable|date',
            'pricing_end_date.*' => 'nullable|date',
            'pricing_description.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('event_images')) {
                $images = $request->file('event_images');
                // For now, we'll use the first image as the main image
                // You can modify this to handle multiple images differently
                if (is_array($images) && count($images) > 0) {
                    $image = $images[0];
                    $imagePath = $image->store('events', 'public');
                } elseif (!is_array($images)) {
                    $imagePath = $images->store('events', 'public');
                }
            }

            // Create event
            $event = Event::create([
                'title' => $request->name,
                'event_type' => $request->type,
                'status' => $request->status,
                'category' => $request->category,
                'description' => $request->description,
                'image' => $imagePath,
                'start_time' => $request->start_date,
                'end_time' => $request->end_date,
                'location' => $request->location,
                'created_by' => Auth::user()->id,
                'max_participants' => $request->max_teams,
                'max_group' => $request->max_groups,
                'max_participants_in_group' => $request->max_teams_in_group,
                'registration_deadline' => $request->registration_deadline,
                'prize_pool' => $request->prize_pool,
            ]);

            // Create pricing tiers if provided
            if ($request->has('pricing_name') && is_array($request->pricing_name)) {
                foreach ($request->pricing_name as $index => $name) {
                    if (!empty($name)) {
                        EventPricing::create([
                            'event_id' => $event->id,
                            'name' => $name,
                            'description' => $request->pricing_description[$index] ?? null,
                            'price' => $request->pricing_price[$index] ?? 0,
                            'start_date' => $request->pricing_start_date[$index] ?? null,
                            'end_date' => $request->pricing_end_date[$index] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Event created successfully',
                'redirect' => route('admin.events.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Delete uploaded image if event creation fails
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to create event: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function show(){
        return view('admin.events.detail');
    }
    
    public function update(){}
    
    public function delete(){}
}
