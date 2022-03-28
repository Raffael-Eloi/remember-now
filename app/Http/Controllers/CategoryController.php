<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $categories = Category::get()->toJson(JSON_PRETTY_PRINT);
        return response($categories, 200);
    }

    public function createCategory(Request $request)
    {
        $category = new Category;
        $category->description = $request->description;
        $category->save();

        return response()->json([
            "message" => "Category created"
        ], 201);
    }

    public function getCategory($id)
    {
        if (Category::where('id', $id)->exists()) {
            $category = Category::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($category, 200);
        } else {
            return response()->json([
                "message" => "Category not found"
            ], 404);
        }
    }

    public function updateCategory(Request $request, $id)
    {
        if (Category::where('id', $id)->exists()) {
            $category = Category::find($id);
            $category->description = is_null($request->description) ? $category->description : $request->description;
            $category->save();

            return response()->json([
                "message" => "Category updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Category not fount"
            ], 404);
        }
    }

    public function deleteCategory($id)
    {
        if (Category::where('id', $id)->exists()) {
            $category = Category::find($id);
            $category->delete();

            return response()->json([
                "message" => "Category deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Category not found"
            ], 404);
        }
    }
}
