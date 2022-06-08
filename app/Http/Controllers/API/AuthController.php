<?php

namespace App\Http\Controllers\API;

use JWTAuth;
use Validator;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public $token = true;

    public function register(Request $request) {
        $validator = Validator::make($request->all(),
        [
            'first_name' => 'required|string|min:2|max:100',
            // 'middle_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'role_id' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            // 'county' => 'required',
            // 'sub_county' => 'required',
            // 'constituency' => 'required',
            // 'ward' => 'required',
            // 'landmark' => 'required',
            'terms_and_conditions' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password|min:6',
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = new User();
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->role_id = $request->role_id;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->county = $request->county;
        $user->sub_county = $request->sub_county;
        $user->constituency = $request->constituency;
        $user->ward = $request->ward;
        $user->landmark = $request->landmark;
        $user->email = $request->email;
        $user->terms_and_conditions = $request->terms_and_conditions;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
  
        // if ($this->token) {
        //     return $this->login($request);
        // }
  
        return response()->json([
            'success' => true,
            'data' => $user
        ], 201);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        if(!$token = auth()->attempt($validator->validated())) {
            return response()->json([
                'error' => 'Unauthorized',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $request->user()
        ], 200);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
  
        try {
            JWTAuth::invalidate($request->token);
  
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function profile(Request $request) {
        return response()->json(auth()->user());

    }
}
