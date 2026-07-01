<?php
namespace App\Http\Controllers;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        return response()->json(['status' => true, 'data' => Gallery::orderBy('sort_order')->get()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category'    => 'nullable|string|max:100',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only(['title', 'description', 'category', 'sort_order', 'is_active']);
        $data['image_path'] = $request->file('image')->store('gallery', 'public');

        return response()->json(['status' => true, 'data' => Gallery::create($data)], 201);
    }

    public function show($id)
    {
        return response()->json(['status' => true, 'data' => Gallery::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category'    => 'nullable|string|max:100',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $item = Gallery::findOrFail($id);
        $data = $request->only(['title', 'description', 'category', 'sort_order', 'is_active']);

        if ($request->hasFile('image')) {
            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $item->update($data);
        return response()->json(['status' => true, 'data' => $item]);
    }

    public function destroy($id)
    {
        $item = Gallery::findOrFail($id);
        if ($item->image_path) {
            Storage::disk('public')->delete($item->image_path);
        }
        $item->delete();
        return response()->json(['status' => true, 'message' => 'Deleted successfully']);
    }
}
