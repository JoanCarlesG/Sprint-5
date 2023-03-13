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
        if (Auth::guard('api')->check() && Auth::guard('api')->user()->hasRole('Admin')) {
            $users = User::all()->map(function ($user) {
                return $user->toArrayWithWinRate();
            });
            return Response(['status' => 200, 'data' => $users], 200);
        } else {
            return Response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }
    }

    public function registerUser(Request $request): Response
    {
        $user = new User();
        $input = $request->all();
        if ($input) {
            $user->name = $this->anonymousName($input, $user);
            $user->password = bcrypt($input['password']);
            $this->rolePerID($user);
            if ($input['email'] != User::find(1)->email) {
                $user->email = $input['email'];
                $user->save();
                return Response(['status' => 201, 'message' => 'User Successfully created', 'data' => $user], 201);
            } else {
                return Response(['status' => 500, 'message' => 'Already registered'], 500);
            }
        } else {
            return Response(['status' => 400, 'message' => 'Failed to register'], 400);
        }
    }
    
    public function anonymousName($input, $user){
        $lastUserId = User::select('id')->orderBy('id', 'desc')->first()->id;
        if (!$input['name']){
            $user->name = "Anonymous".($lastUserId + 1);
        } else{
            $user->name = $input['name'];
        };
        return $user->name;
    }

    public function rolePerID($user){
        if ($user->id == 1) {
            $user->assignRole('Admin');
        } else {
            $user->assignRole('Player');
        }
    }

    public function loginUser(Request $request): Response
    {
        $input = $request->all();

        if (Auth::attempt($input)) {
            $user = Auth::user();
            $token = $user->createToken('example')->accessToken;
            $role = $user->roles->first()->name;
            if ($role == "Admin"){
                $roleNum = 1;
            } else {
                $roleNum = 0;
            }
            return Response(['status' => 200, 'token' => $token, 'user' => $user, 'role' => $role, 'roleNum' => $roleNum, 'message' => 'Login successful'], 200);
        } else {
            return Response(['status' => 401, 'message' => 'Invalid credentials'], 401);
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
            return Response(['status' => 200, 'Total games' => count($userGames), 'games' => $userGames], 200);
        } else {
            return Response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }
    }

    public function createGame($id): Response
    {
        $user = User::find($id);

        if (!$user) {
            return Response(['status' => 404, 'message' => 'User not found'], 404);
        }

        if (Auth::guard('api')->check() && Auth::guard('api')->id() == $id) {
            User::newGame($user);
            $game = $user->games->last();
            if ($game->win == 2) {
                return Response(['status' => 201, 'message' => 'Game Successfully created', 'data' => $game, 'result' => 'YOU LOSE!'], 201);
            } else {
                return Response(['status' => 201, 'message' => 'Game Successfully created', 'data' => $game, 'result' => 'YOU WIN!'], 201);
            }
        } else {
            return Response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }
    }

    public function deleteGames($id): Response
    {
        $user = User::find($id);

        if (!$user) {
            return Response(['status' => 404, 'message' => 'User not found'], 404);
        }

        if (Auth::guard('api')->check() && Auth::guard('api')->id() == $id) {
            User::deleteGames($user);
            return Response(['status' => 200, 'message' => 'Games Successfully deleted'], 200);
        } else {
            return Response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }
    }

    public function createRanking()
    {
        $users = User::all()->map(function ($user) {
            return [
                'name' => $user->name,
                'win_rate' => $user->winRate(),
            ];
        })->sortByDesc('win_rate')->values()->toArray();
        return $users;
    }

    public function getRanking(): Response
    {
        if (Auth::guard('api')->check() && Auth::guard('api')) {
            $users = $this->createRanking();
            return Response(['status' => 200, 'data' => $users], 200);
        } else {
            return Response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }
    }

    public function getWorstPlayer(): Response
    {
        if (Auth::guard('api')->check() && Auth::guard('api')) {
            $users = $this->createRanking();
            return Response(['status' => 200, 'data' => end($users)], 200);
        } else {
            return Response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }
    }

    public function getBestPlayer(): Response
    {
        if (Auth::guard('api')->check() && Auth::guard('api')) {
            $users = $this->createRanking();
            return Response(['status' => 200, 'data' => $users[0]], 200);
        } else {
            return Response(['status' => 401, 'message' => 'Unauthorized'], 401);
        }
    }
}
