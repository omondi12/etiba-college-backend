<?php
namespace App\Http\Controllers;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        return response()->json(['status'=>true,'data'=>Testimonial::orderBy('sort_order')->orderBy('created_at','desc')->get()]);
    }
    public function store(Request $request)
    {
        $item = Testimonial::create($request->all());
        return response()->json(['status'=>true,'data'=>$item],201);
    }
    public function show($id)
    {
        return response()->json(['status'=>true,'data'=>Testimonial::findOrFail($id)]);
    }
    public function update(Request $request, $id)
    {
        $item = Testimonial::findOrFail($id);
        $item->update($request->all());
        return response()->json(['status'=>true,'data'=>$item]);
    }
    public function destroy($id)
    {
        Testimonial::findOrFail($id)->delete();
        return response()->json(['status'=>true,'message'=>'Deleted successfully']);
    }
}
