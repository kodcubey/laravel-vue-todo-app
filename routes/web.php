<?php

use App\Models\GetAllData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-all-data', function () {
    return response()->json(GetAllData::all());
});

Route::post('/add-item', function (Request $request) {
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
});

Route::get('/completed-item/{id}', function (Request $request, $id) {
    $getId = GetAllData::where('id', $id)->get()[0]->isTrue;

    if (!$getId) {
        GetAllData::where('id', $id)->update(['isTrue' => true]);
        return response()->json(GetAllData::all());
    }

    GetAllData::where('id', $id)->update(['isTrue' => false]);
    return response()->json(GetAllData::all());
});

Route::get('/delete-item/{id}', function (Request $request, $id) {
    GetAllData::destroy($id);
    return response()->json(GetAllData::all());
});
