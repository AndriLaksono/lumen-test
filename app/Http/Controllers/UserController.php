<?php
namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (!empty($request->with)){
                $user = User::with($request->with)->get();
            }else {
                $user = User::all();
            }
            return response()->json([
                "status" => "success",
                "data" => $user
            ]);
    
        }catch(Exception $e) {
            return response(400)->json([
                "status" => "success",
                "message" => "Bad request"
            ]);
        }
        return $response;
    }

    public function view(Request $request, string $user)
    {
        try {
            $user = User::where('fullname', $user)->orWhere('id', $user)->orWhere('email', $user)->first();
            
            return response()->json([
                "status" => "success",
                "data" => $user
            ]);
        }catch(Exception $e) {
            return response(400)->json([
                "status" => "success",
                "message" => "Bad request"
            ]);
        }
    }
}
