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
    $players = User::withCount(['games', 'wins'])->get();
    
    $players = $players->map(function($player) {
        $player->victory_percentage = $player->games_count > 0 ? round($player->wins_count / $player->games_count * 100, 2) : 0;
        return $player;
    });
    
    return response()->json($players);
}


    public function loginUser(Request $request): Response
    {
        $input = $request->all();

        Auth::attempt($input);

        $user = Auth::user();
        $token = $user->createToken('example ')->accessToken;
        return Response(['status' => 200, 'token' => $token], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getUserDetail(): Response
    {
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            return Response(['status' => 200, 'user' => $user], 200);
        } else {
            return Response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }
    }

    public function getAllUsers(): Response
    {
        if (Auth::guard('api')->check()) {
            $users = Auth::guard('api')->all();
            return Response(['status' => 200, 'users' => $users], 200);
        } else {
            return Response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }
    }

    /**
     * Display the specified resource.
     */
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
}
