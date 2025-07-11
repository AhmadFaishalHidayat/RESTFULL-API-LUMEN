<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return response()->json(Post::all(), 200);
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
        $validator = Validator::make($request->all(), [
            'title'   => 'required|min:5',
            'content' => 'required|min:10',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        };

        $post = Post::create($request->only(['title', 'content']));
        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dibuat',
            'data'    => $post,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
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
