<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
            return response()->json(Category::all(), 200);
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
            $category = Category::find($id);
            if (!$category) {
                return response()->json([
                    'message' => 'Not Found',
                    'status' => 404
                ], 404);
            }
            return response()->json([
                'data' => $category,
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
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:3|unique:categories,name|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bad Request',
                    'status' => 400,
                    'errors' => $validator->errors(),
                ], 400);
            }

            $category = Category::create($request->only(['name']));
            return response()->json([
                'success' => true,
                'message' => 'Category created successfully',
                'data'    => $category,
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
            $category = Category::find($id);
            if (!$category) {
                return response()->json([
                    'message' => 'Not Found',
                    'status' => 404
                ], 404);
            }
            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $id,
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bad Request',
                    'status' => 400,
                    'errors' => $validator->errors(),
                ], 400);
            }

            $category->update($request->only(['name']));
            return response()->json([
                'message' => 'Category updated successfully',
                'data' => $category,
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
            $category = Category::find($id);
            if (!$category) {
                return response()->json([
                    'message' => 'Not Found',
                    'status' => 404
                ], 404);
            }

            $category->delete();
            return response()->json([
                'message' => 'Category deleted successfully',
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

    public function showPostsByCategory($id)
    {
        try {
            $category = Category::with('posts')->find($id);
            if (!$category) {
                return response()->json(['message' => 'Not Found'], 404);
            }
            return response()->json([
                'data' => $category,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
