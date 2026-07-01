<?php
namespace App\Http\Controllers;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        return response()->json(['status' => true, 'data' => TeamMember::orderBy('sort_order')->orderBy('created_at', 'desc')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'position'   => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'bio'        => 'nullable|string',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|string|max:30',
            'is_active'  => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        return response()->json(['status' => true, 'data' => TeamMember::create($data)], 201);
    }

    public function show($id)
    {
        return response()->json(['status' => true, 'data' => TeamMember::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'       => 'sometimes|required|string|max:255',
            'position'   => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'bio'        => 'nullable|string',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|string|max:30',
            'is_active'  => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $item = TeamMember::findOrFail($id);

        if ($request->hasFile('photo')) {
            if ($item->photo) Storage::disk('public')->delete($item->photo);
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        $item->update($data);
        return response()->json(['status' => true, 'data' => $item]);
    }

    public function destroy($id)
    {
        $item = TeamMember::findOrFail($id);
        if ($item->photo) Storage::disk('public')->delete($item->photo);
        $item->delete();
        return response()->json(['status' => true, 'message' => 'Deleted successfully']);
    }
}
