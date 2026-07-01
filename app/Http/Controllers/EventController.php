<?php
namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return response()->json(['status' => true, 'data' => Event::orderBy('sort_order')->orderBy('created_at', 'desc')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date'  => 'required|date',
            'event_time'  => 'nullable|string|max:50',
            'location'    => 'nullable|string|max:255',
            'category'    => 'nullable|string|max:100',
            'is_active'   => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);
        return response()->json(['status' => true, 'data' => Event::create($data)], 201);
    }

    public function show($id)
    {
        return response()->json(['status' => true, 'data' => Event::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'event_date'  => 'sometimes|required|date',
            'event_time'  => 'nullable|string|max:50',
            'location'    => 'nullable|string|max:255',
            'category'    => 'nullable|string|max:100',
            'is_active'   => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);
        $item = Event::findOrFail($id);
        $item->update($data);
        return response()->json(['status' => true, 'data' => $item]);
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return response()->json(['status' => true, 'message' => 'Deleted successfully']);
    }
}
