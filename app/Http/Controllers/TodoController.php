<?php

namespace App\Http\Controllers;

use App\Models\GetAllData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Add Item.
     *
     * @return \Illuminate\Http\Response
     */
    public function addItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors(),
            ]);
        }

        GetAllData::create([
            'title' => $request->all()["title"],
            'description' => $request->all()["description"],
            'isTrue' => 0
        ]);

        return response()->json(GetAllData::all());
    }

    /**
     * get all data.
     */
    public function getAllData()
    {
        return response()->json(GetAllData::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCompated($id)
    {
        $getId = GetAllData::where('id', $id)->get()[0]->isTrue;

        if (!$getId) {
            GetAllData::where('id', $id)->update(['isTrue' => true]);
            return response()->json(GetAllData::all());
        }

        GetAllData::where('id', $id)->update(['isTrue' => false]);
        return response()->json(GetAllData::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteItem($id)
    {
        GetAllData::destroy($id);
        return response()->json(GetAllData::all());
    }
}
