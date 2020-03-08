<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\Auth\UserNotFound;

class UserController extends Controller
{
    public function token(Request $request)
    {
        $request->validate([
            'uid' => 'required'
        ]);

        $auth = app('firebase.auth');
        $data = [];
        try {
            $firebase_user = $auth->getUser($request->input('uid'));
            $user = User::where('mobile', $firebase_user->phoneNumber)->first();
            if (!$user) {
                throw new Exception('User not found');
            }
            $user->tokens()->delete();
            $token = $user->createToken($user->name)->plainTextToken;
            $data = [
                'token' => $token
            ];
        }
        catch (UserNotFound $exception) {
            $data = [
                'message' => 'User not found'
            ];
        }
        catch (Exception $exception) {
            $data = [
                'message' => $exception->getMessage()
            ];
        }

        return response()->json($data);
    }

    public function show(Request $request) {
        return $request->user();
    }
}
