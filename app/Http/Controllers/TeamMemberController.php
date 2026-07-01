<?php
namespace App\Http\Controllers;
use App\Models\TeamMember;
use Illuminate\Http\Request;

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
            'photo'      => 'nullable|string|max:500',
            'is_active'  => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);
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
            'photo'      => 'nullable|string|max:500',
            'is_active'  => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);
        $item = TeamMember::findOrFail($id);
        $item->update($data);
        return response()->json(['status' => true, 'data' => $item]);
    }

    public function destroy($id)
    {
        TeamMember::findOrFail($id)->delete();
        return response()->json(['status' => true, 'message' => 'Deleted successfully']);
    }
}
