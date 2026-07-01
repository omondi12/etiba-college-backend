<?php
namespace App\Http\Controllers;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        return response()->json(['status' => true, 'data' => Testimonial::orderBy('sort_order')->orderBy('created_at', 'desc')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'role'       => 'nullable|string|max:255',
            'quote'      => 'required|string',
            'rating'     => 'nullable|integer|min:1|max:5',
            'is_active'  => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);
        return response()->json(['status' => true, 'data' => Testimonial::create($data)], 201);
    }

    public function show($id)
    {
        return response()->json(['status' => true, 'data' => Testimonial::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'       => 'sometimes|required|string|max:255',
            'role'       => 'nullable|string|max:255',
            'quote'      => 'sometimes|required|string',
            'rating'     => 'nullable|integer|min:1|max:5',
            'is_active'  => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);
        $item = Testimonial::findOrFail($id);
        $item->update($data);
        return response()->json(['status' => true, 'data' => $item]);
    }

    public function destroy($id)
    {
        Testimonial::findOrFail($id)->delete();
        return response()->json(['status' => true, 'message' => 'Deleted successfully']);
    }
}
