<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Hash;

class UserController extends Controller {

//*
	public $successStatus = 200;
/**
 * login api
 *
 * @return \Illuminate\Http\Response
 */
	public function login(Request $request) {

        $credentials = $request->only('username', 'password');


		if (Auth::attempt($credentials)) {
			$user = Auth::user();
			$success['token'] = $user->createToken('MyApp')->accessToken;
			return response()->json(['success' => $success], $this->successStatus);
		} else {
		    $user = User::where('username', $request->username)->first();
			return response()->json(['error' => 'User/Password invalid'], 401);
		}
	}
	/**
	 * Register api
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request) {
		$validator = Validator::make($request->all(), [
			'username' => 'required|unique:users',
			'password' => 'required',
			'c_password' => 'required|same:password',
		]);
		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 401);
		}
		$input = $request->all();
		$input['password'] = bcrypt($input['password']);
		$user = User::create($input);
		$success['token'] = $user->createToken('MyApp')->accessToken;
		$success['name'] = $user->name;
		return response()->json(['success' => $success], $this->successStatus);
	}

	/**
	 * details api
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function details() {
		$user = Auth::user();
		return response()->json(['success' => $user], $this->successStatus);
	}

	public function logoutApi() {
		if (Auth::check()) {
			Auth::user()->AauthAcessToken()->delete();
		}
	}

}
