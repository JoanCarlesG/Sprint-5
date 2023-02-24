<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;

class UserController extends Controller
{
    public function getPlayers()
    {
        $users = User::all()->map(function ($user) {
            return $user->toArrayWithWinRate();
        });
        return response()->json($users);
    }

    public function registerUser(Request $request): Response
    {
        $user = new User();
        $input = $request->all();
        if ($input) {
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->password = bcrypt($input['password']);
            $user->save();
            return Response(['status' => 201, 'message' => 'Successfully registered', 'data' => $user], 201);
        } else {
            return Response(['status' => 400, 'message' => 'Failed to register'], 400);
        }
    }

    public function loginUser(Request $request): Response
    {
        $input = $request->all();

        Auth::attempt($input);

        $user = Auth::user();

        $token = $user->createToken('example ')->accessToken;
        return Response(['status' => 200, 'token' => $token, 'message' => 'Login successfull'], 200);
    }

    public function getUserDetail(): Response
    {
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            return Response(['status' => 200, 'user' => $user], 200);
        } else {
            return Response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }
    }

    public function userLogout(): Response
    {
        if (Auth::guard('api')->check()) {
            $accessToken = Auth::guard('api')->user()->token();
            \DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update([
                    'revoked' => true
                ]);
            $accessToken->revoke();
            return Response(['status' => 200, 'message' => 'Successfully logged out'], 200);
        } else {
            return Response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }
    }

    public function updateName(Request $request): Response
    {
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            $user->name = $request->name;
            $user->save();
            return Response(['status' => 200, 'message' => 'Successfully updated'], 200);
        } else {
            return Response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }
    }

    public function getUserGames($id): Response
    {
        $user = User::find($id);

        if (!$user) {
            return Response(['status' => 404, 'message' => 'User not found'], 404);
        }

        if (Auth::guard('api')->check() && Auth::guard('api')->id() == $id) {
            $userGames = $user->games;
            if (empty($userGames))
            // NO DATA
            return Response(['status' => 200, 'userGames' => $userGames], 200);
        } else {
            return Response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }
    }
}
