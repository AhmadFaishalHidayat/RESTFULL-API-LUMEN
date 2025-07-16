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
        try {
            $user = auth()->user();
            return response()->json(Post::with('category')->get(), 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 500,
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $post = Post::with('category')->find($id);
            if (!$post) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            return response()->json([
                'data' => $post,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 500,
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            $validator = Validator::make($request->all(), [
                'title'   => 'required|min:5',
                'content' => 'required|min:10',
                'category_id' => 'required|exists:categories,id',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bad Request',
                    'status' => 400,
                    'errors' => $validator->errors(),
                ], 400);
            }

            $post = Post::create([
                'title'       => $request->input('title'),
                'content'     => $request->input('content'),
                'category_id' => $request->input('category_id'),
                'user_id'     => $user->id
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Post berhasil dibuat',
                'data'    => $post,
                'status' => 201
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 500,
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            $post = Post::find($id);
            if (!$post) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            $validator = Validator::make($request->all(), [
                'title'   => 'sometimes|required|min:5',
                'content' => 'sometimes|required|min:10',
                'category_id' => 'sometimes|required|exists:categories,id',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bad Request',
                    'status' => 400,
                    'errors' => $validator->errors(),
                ], 400);
            }

            $post->update($request->only(
                [
                    'title'       => $request->input('title'),
                    'content'     => $request->input('content'),
                    'category_id' => $request->input('category_id'),
                    'user_id'     => $user->id
                ]
            ));
            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully',
                'data' => $post,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 500,
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            $post->delete();
            return response()->json([
                'message' => 'Deleted Successfully',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 500,
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function getFiltered(Request $request)
    {
        try {
            // Ambil input
            $limit  = $request->input('limit') ?? 10;
            $offset = $request->input('offset') ?? 0;

            // Ambil filter (JSON)
            $filter = json_decode($request->input('filter'), true);
            if ($filter == null) {
                $filter = json_decode(urldecode($request->input('filter')), true);
            }

            // Ambil sort (JSON)
            $sort = json_decode($request->input('sort'), true);
            if ($sort == null) {
                $sort = json_decode(urldecode($request->input('sort')), true);
            }

            // Build query
            $query = Post::query();

            // Apply filter
            if ($filter && isset($filter['category_id'])) {
                $query->where('category_id', $filter['category_id']);
            }

            // Apply sort
            if ($sort && isset($sort['field']) && isset($sort['dir'])) {
                $query->orderBy($sort['field'], $sort['dir']);
            } else {
                $query->orderBy('created_at', 'desc'); // default
            }

            // Total data (tanpa limit)
            $total = $query->count();

            // Ambil data sesuai limit & offset
            $posts = $query->skip($offset)->take($limit)->get();

            return response()->json([
                'success' => true,
                'data'    => $posts,
                'meta'    => [
                    'total'  => $total,
                    'limit'  => (int) $limit,
                    'offset' => (int) $offset
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
