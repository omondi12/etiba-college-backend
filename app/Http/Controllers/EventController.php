<?php
namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return response()->json(['status'=>true,'data'=>Event::orderBy('sort_order')->orderBy('created_at','desc')->get()]);
    }
    public function store(Request $request)
    {
        $item = Event::create($request->all());
        return response()->json(['status'=>true,'data'=>$item],201);
    }
    public function show($id)
    {
        return response()->json(['status'=>true,'data'=>Event::findOrFail($id)]);
    }
    public function update(Request $request, $id)
    {
        $item = Event::findOrFail($id);
        $item->update($request->all());
        return response()->json(['status'=>true,'data'=>$item]);
    }
    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return response()->json(['status'=>true,'message'=>'Deleted successfully']);
    }
}
