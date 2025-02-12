<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FullCalenderController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::select('id', 'title', 'start', 'end')->get()
                ->map(function ($event) {
                    return [
                        'id' => $event->id,
                        'title' => $event->title,
                        'start' => $event->start->format('Y-m-d\TH:i:s'),
                        'end' => $event->end ? $event->end->format('Y-m-d\TH:i:s') : null,
                        'color' => '#007bff'  
                    ];
                });
    
            return response()->json($data);
        }
    
        return view('events.full-calendar');
    }
    
 
    public function ajax(Request $request)
{
    switch ($request->type) {
        case 'add':
            $event = Event::create([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
            ]);
            return response()->json($event);
            break;

        case 'update':
            $event = Event::find($request->id);
            if ($event) {
                $event->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
            }
            return response()->json($event);
            break;

        case 'delete':
            Event::find($request->id)->delete();
            return response()->json(['status' => 'Deleted']);
            break;
    }
}

}
