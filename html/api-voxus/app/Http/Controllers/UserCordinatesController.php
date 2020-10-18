<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserCordinates;

class UserCordinatesController extends Controller
{
    public function save(Request $request){
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'user_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors(), 422);

        $coodinates = UserCordinates::create([
            'user_id' => $request->user_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        return response()->json(['success' => 'Usuário cadastrado com sucesso!'], 200);

    }

    public function show($id){
      $users = UserCordinates::all()->where('user_id', $id);
      return response()->json([$users, 200]);
    }
}
