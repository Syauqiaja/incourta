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
    public function index()
    {
        $events = Event::with(['pricings', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
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
            'event_images.*' => 'required|string',
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

        $image = \json_decode($request->event_images)[0] ?? null;

        try {
            DB::beginTransaction();

            // Create event
            $event = Event::create([
                'title' => $request->name,
                'event_type' => $request->type,
                'status' => $request->status,
                'category' => $request->category,
                'description' => $request->description,
                'image' => Storage::url($image),
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

            return response()->json([
                'success' => false,
                'message' => 'Failed to create event: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $event = Event::with(['pricings', 'creator'])->findOrFail($id);
        return view('admin.events.detail', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::with('pricings')->findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
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
            'event_images.*' => 'nullable|string',
            'registration_deadline' => 'nullable|date|before:start_date',
            'prize_pool' => 'nullable|string|max:255',
            'pricing_id.*' => 'nullable|exists:event_pricings,id',
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

            $event = Event::findOrFail($id);
            $oldImage = $event->image;

            // Handle image upload
            $imagePath = $oldImage;
            if ($request->has('event_images') && $request->event_images) {
                $imageData = json_decode($request->event_images);
                if (!empty($imageData) && isset($imageData[0])) {
                    $newImage = $imageData[0];
                    $imagePath = Storage::url($newImage);
                    
                    // Delete old image if it's different from the new one
                    if ($oldImage && $oldImage !== $imagePath) {
                        // Extract the path from the URL
                        $oldImagePath = str_replace('/storage/', '', $oldImage);
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }
            }

            // Update event
            $event->update([
                'title' => $request->name,
                'event_type' => $request->type,
                'status' => $request->status,
                'category' => $request->category,
                'description' => $request->description,
                'image' => $imagePath,
                'start_time' => $request->start_date,
                'end_time' => $request->end_date,
                'location' => $request->location,
                'max_participants' => $request->max_teams,
                'max_group' => $request->max_groups,
                'max_participants_in_group' => $request->max_teams_in_group,
                'registration_deadline' => $request->registration_deadline,
                'prize_pool' => $request->prize_pool,
            ]);

            // Handle pricing updates
            $existingPricingIds = [];
            
            if ($request->has('pricing_name') && is_array($request->pricing_name)) {
                foreach ($request->pricing_name as $index => $name) {
                    if (!empty($name)) {
                        $pricingData = [
                            'event_id' => $event->id,
                            'name' => $name,
                            'description' => $request->pricing_description[$index] ?? null,
                            'price' => $request->pricing_price[$index] ?? 0,
                            'start_date' => $request->pricing_start_date[$index] ?? null,
                            'end_date' => $request->pricing_end_date[$index] ?? null,
                        ];

                        // Check if this is an update or create
                        if (isset($request->pricing_id[$index]) && $request->pricing_id[$index]) {
                            $pricingId = $request->pricing_id[$index];
                            $pricing = EventPricing::find($pricingId);
                            if ($pricing && $pricing->event_id === $event->id) {
                                $pricing->update($pricingData);
                                $existingPricingIds[] = $pricingId;
                            }
                        } else {
                            $newPricing = EventPricing::create($pricingData);
                            $existingPricingIds[] = $newPricing->id;
                        }
                    }
                }
            }

            // Delete pricing tiers that were removed
            EventPricing::where('event_id', $event->id)
                ->whereNotIn('id', $existingPricingIds)
                ->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Event updated successfully',
                'redirect' => route('admin.events.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update event: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $event = Event::findOrFail($id);

            // Delete event image if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }

            // Delete event (pricings will be cascade deleted)
            $event->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Event deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete event: ' . $e->getMessage()
            ], 500);
        }
    }
}
