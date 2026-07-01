<?php
namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return response()->json(['status' => true, 'data' => Article::orderBy('sort_order')->orderBy('created_at', 'desc')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'nullable|string|max:100',
            'author'       => 'nullable|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'published_at' => 'nullable|date',
            'is_active'    => 'nullable|boolean',
            'sort_order'   => 'nullable|integer',
        ]);
        return response()->json(['status' => true, 'data' => Article::create($data)], 201);
    }

    public function show($id)
    {
        return response()->json(['status' => true, 'data' => Article::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title'        => 'sometimes|required|string|max:255',
            'category'     => 'nullable|string|max:100',
            'author'       => 'nullable|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'sometimes|required|string',
            'published_at' => 'nullable|date',
            'is_active'    => 'nullable|boolean',
            'sort_order'   => 'nullable|integer',
        ]);
        $item = Article::findOrFail($id);
        $item->update($data);
        return response()->json(['status' => true, 'data' => $item]);
    }

    public function destroy($id)
    {
        Article::findOrFail($id)->delete();
        return response()->json(['status' => true, 'message' => 'Deleted successfully']);
    }
}
