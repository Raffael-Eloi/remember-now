<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function getAllItems()
    {
        $items = Item::get()->toJson(JSON_PRETTY_PRINT);
        return response($items, 200);
    }

    public function createItem(Request $request)
    {
        $item = new Item;
        $item->user_id = $request->user_id;
        $item->category_id = $request->category_id;
        $item->status_id = $request->status_id;
        $item->description = $request->description;
        $item->answer = $request->answer;
        $item->save();

        return response()->json([
            "message" => "Item created"
        ], 201);
    }

    public function getItem($id)
    {
        if (Item::where('id', $id)->exists()) {
            $item = Item::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($item, 200);
        } else {
            return response()->json([
                "message" => "Item not found"
            ], 404);
        }
    }

    public function updateItem(Request $request, $id)
    {
        if (Item::where('id', $id)->exists()) {
            $item = Item::find($id);
            $item->description = is_null($request->description) ? $item->description : $request->description;
            $item->answer = is_null($request->answer) ? $item->answer : $request->answer;
            $item->user_id = is_null($request->user_id) ? $item->user_id : $request->user_id;
            $item->category_id = is_null($request->category_id) ? $item->category_id : $request->category_id;
            $item->status_id = is_null($request->status_id) ? $item->status_id : $request->status_id;
            $item->save();

            return response()->json([
                "message" => "Item updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Item not found"
            ], 404);
        }
    }

    public function deleteItem($id)
    {
        if (Item::where('id', $id)->exists()) {
            $Item = Item::find($id);
            $Item->delete();

            return response()->json([
                "message" => "Item deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Item not found"
            ], 404);
        }
    }
}
