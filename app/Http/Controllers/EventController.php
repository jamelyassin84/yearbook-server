<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    private $relationships = [
        'schoolYear',
    ];

    public function index(Request $request)
    {
        $filters = $request->only(['school_year_id']);
        $query = Event::query();
        foreach ($filters as $filter => $value) {
            if (isset($value)) {
                $query->where($filter, $value);
            }
        }
        $events = $query->with($this->relationships)->get();
        return response()->json($events);
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        $payload['date'] = Carbon::parse($payload['date'])->format('Y-m-d H:i:s');
        $event = Event::create($payload);
        $event->load($this->relationships);
        return response()->json($event, 201);
    }

    public function show(Event $event)
    {
        $event->load($this->relationships);
        return response()->json($event);
    }

    public function update(Request $request, Event $event)
    {
        $event->fill($request->all())->save();
        $event->load($this->relationships);
        return response()->json($event);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully']);
    }
}
