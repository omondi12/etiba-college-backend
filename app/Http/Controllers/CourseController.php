<?php
namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return response()->json(['status'=>true,'data'=>Course::orderBy('sort_order')->orderBy('created_at','desc')->get()]);
    }
    public function store(Request $request)
    {
        $item = Course::create($request->all());
        return response()->json(['status'=>true,'data'=>$item],201);
    }
    public function show($id)
    {
        return response()->json(['status'=>true,'data'=>Course::findOrFail($id)]);
    }
    public function update(Request $request, $id)
    {
        $item = Course::findOrFail($id);
        $item->update($request->all());
        return response()->json(['status'=>true,'data'=>$item]);
    }
    public function destroy($id)
    {
        Course::findOrFail($id)->delete();
        return response()->json(['status'=>true,'message'=>'Deleted successfully']);
    }
}
