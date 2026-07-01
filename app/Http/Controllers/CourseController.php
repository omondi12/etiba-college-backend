<?php
namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return response()->json(['status' => true, 'data' => Course::orderBy('sort_order')->orderBy('created_at', 'desc')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'category'     => 'required|in:certificate,diploma,short_course',
            'duration'     => 'required|string|max:100',
            'requirements' => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'is_active'    => 'nullable|boolean',
            'sort_order'   => 'nullable|integer',
        ]);
        return response()->json(['status' => true, 'data' => Course::create($data)], 201);
    }

    public function show($id)
    {
        return response()->json(['status' => true, 'data' => Course::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'         => 'sometimes|required|string|max:255',
            'category'     => 'sometimes|required|in:certificate,diploma,short_course',
            'duration'     => 'sometimes|required|string|max:100',
            'requirements' => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'is_active'    => 'nullable|boolean',
            'sort_order'   => 'nullable|integer',
        ]);
        $item = Course::findOrFail($id);
        $item->update($data);
        return response()->json(['status' => true, 'data' => $item]);
    }

    public function destroy($id)
    {
        Course::findOrFail($id)->delete();
        return response()->json(['status' => true, 'message' => 'Deleted successfully']);
    }
}
