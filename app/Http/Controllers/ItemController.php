<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //to import DB class from laravel

class ItemController extends Controller
{
    public function index() {
        return DB::table('items')->get();
    }

    //for store data (admin's portal)
    public function store(Request $request) {
        DB::table('items')->insert([
            'name' => $request->name,
            'shape' => $request->shape,
            'color' => $request->color,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return response()->json(['message' => 'Data disimpan!']);
    }

    //update
    public function update(Request $request, $id){
    DB::table('items')
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'shape' => $request->shape,
            'color' => $request->color,
            'updated_at' => now(),
        ]);

    return response()->json([
        'message' => 'Entry updated successfully.'
    ]);
    }

    public function destroy($id){
    DB::table('items')
        ->where('id', $id)
        ->delete();

    return response()->json([
        'message' => 'Entry deleted successfully.'
    ]);}

    
}
