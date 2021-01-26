<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SecureController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');	
	}

	public function profile(Request $request)
	{
		if(!empty($request->header('Authorization'))){
			$token = $request->header('Authorization');
			$token = explode(" ", $token);
			$user = User::where('token', $token[1])->first();
			
			return response()->json([
                "status" => "success",
                "data" => $user
            ]);
		}else {
			return response(400)->json([
                "status" => "error",
                "data" => "Unauthorized"
            ]);
		}
	}
}