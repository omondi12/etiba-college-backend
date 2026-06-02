<?php
namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return response()->json(['status'=>true,'data'=>Article::orderBy('sort_order')->orderBy('created_at','desc')->get()]);
    }
    public function store(Request $request)
    {
        $item = Article::create($request->all());
        return response()->json(['status'=>true,'data'=>$item],201);
    }
    public function show($id)
    {
        return response()->json(['status'=>true,'data'=>Article::findOrFail($id)]);
    }
    public function update(Request $request, $id)
    {
        $item = Article::findOrFail($id);
        $item->update($request->all());
        return response()->json(['status'=>true,'data'=>$item]);
    }
    public function destroy($id)
    {
        Article::findOrFail($id)->delete();
        return response()->json(['status'=>true,'message'=>'Deleted successfully']);
    }
}
