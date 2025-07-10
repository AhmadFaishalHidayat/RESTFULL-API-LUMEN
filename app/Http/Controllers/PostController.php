<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return response () -> json (Post::all(), 200);
    }

    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($post, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create($request->only(['title', 'content']));
        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if(!$post) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $this->validate($request, [
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        $post->update($request->only(['title', 'content']));
        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $post->delete();
        return response()->json(['message' => 'Deleted Successfully'], 200);
    }
    
    //
}
