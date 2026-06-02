<?php
namespace App\Http\Controllers;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        return response()->json(['status'=>true,'data'=>TeamMember::orderBy('sort_order')->orderBy('created_at','desc')->get()]);
    }
    public function store(Request $request)
    {
        $item = TeamMember::create($request->all());
        return response()->json(['status'=>true,'data'=>$item],201);
    }
    public function show($id)
    {
        return response()->json(['status'=>true,'data'=>TeamMember::findOrFail($id)]);
    }
    public function update(Request $request, $id)
    {
        $item = TeamMember::findOrFail($id);
        $item->update($request->all());
        return response()->json(['status'=>true,'data'=>$item]);
    }
    public function destroy($id)
    {
        TeamMember::findOrFail($id)->delete();
        return response()->json(['status'=>true,'message'=>'Deleted successfully']);
    }
}
