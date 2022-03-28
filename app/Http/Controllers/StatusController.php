<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function getAllStatus()
    {
        $status = Status::get()->toJson(JSON_PRETTY_PRINT);
        return response($status, 200);
    }

    public function createStatus(Request $request)
    {
        $status = new Status;
        $status->description = $request->description;
        $status->save();

        return response()->json([
            "message" => "status created"
        ], 201);
    }

    public function getStatus($id)
    {
        if (Status::where('id', $id)->exists()) {
            $status = Status::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($status, 200);
        } else {
            return response()->json([
                "message" => "Status not found"
            ], 404);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        if (Status::where('id', $id)->exists()) {
            $status = Status::find($id);
            $status->description = is_null($request->description) ? $status->description : $request->description;
            $status->save();

            return response()->json([
                "message" => "Status updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Status not fount"
            ], 404);
        }
    }

    public function deleteStatus($id)
    {
        if (Status::where('id', $id)->exists()) {
            $status = Status::find($id);
            $status->delete();

            return response()->json([
                "message" => "Status deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Status not found"
            ], 404);
        }
    }
}
