<?php

namespace App\Http\Controllers;

use App\Establishment;
use App\EstablishmentType;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\Auth\UserNotFound;

class UserController extends Controller
{
    public function token(Request $request)
    {
        $request->validate([
            'id_token' => 'required',
        ]);

        $auth = app('firebase.auth');
        $data = [];
        try {
            $id_token = $request->get('id_token');
            $verifiedIdToken = $auth->verifyIdToken($id_token);
            $mobile = str_replace('+91', '', $verifiedIdToken->getClaim('phone_number'));
            $user = User::where('mobile', $mobile)->first();
            if (!$user) {
                throw new Exception('User not found');
            }
            $token = $user->createToken($user->name)->plainTextToken;
            $data = [
                'data' => [
                    'token' => $token
                ]
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

    public function home(Request $request) {
        $user = $request->user();
        $establishment_types = EstablishmentType::get();
        $response = ['data' => []];
        foreach ($establishment_types as $establishment_type) {
            $response['data'][] = [
                'id' => $establishment_type->id,
                'label' => $establishment_type->name,
                'color' => $establishment_type->color,
                'count' => $user->establishments()->ofType($establishment_type->name)->active()->registered()->count()
            ];
        }
        $response['data'][] = [
            'id' => 'beat',
            'label' => 'BEATS',
            'color' => '0xFF8CDCDA',
            'count' =>  $user->beats()->count()
        ];
        return response()->json($response);
    }

    public function show(Request $request) {
        return $request->user();
    }
}
