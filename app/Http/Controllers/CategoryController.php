<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; //panggil model category
use Illuminate\Support\Facades\Validator; //panggil library validator

class CategoryController extends Controller
{
    public function Create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);

        if($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }

        $payload = $validator->validated();

        Category::create([
            'name' => $payload['name']
        ]);

        return response()->json([
            'msg' => 'Category successfully created'
        ], 201);
    }

    public function Show(Request $request) {
        $categories = Category::all();

        return response()->json([
            'msg' => 'List of all categories',
            'data' => $categories
        ], 200);
    }

    public function Update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);

        if($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }

        $payload = $validator->validated();

        $categories = Category::find($id);

        if($categories) {
            $categories->update([
                'name' => $payload['name']
            ]);
    
            return response()->json([
                'msg' => 'Category with ID: '.$id.' succesfully updated',
            ], 200);

        } else {
            return response()->json([
                'msg' => 'Category with ID: '.$id.' not found'
            ], 404);
        }

    }

    public function Delete(Request $request, $id) {
        $categories = Category::find($id);

        if($categories) {
            $categories->delete();

            return response()->json([
                'msg' => 'Category with ID: '.$id.' successfully deleted' 
            ], 200);
        } else {
            return response()->json([
                'msg' => 'Category with ID: '.$id.' not found'
            ], 404);
        }

    }
}
