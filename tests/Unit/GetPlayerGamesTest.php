<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetPlayerGamesTest extends TestCase
{
    /**
     * @test
     */
    public function games_can_be_retrieved(): void
    {
        $user = User::factory()->create();
        User::newGame($user);
        $token = $user->createToken('example ')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/players/'.$user->id.'/games/');
        
        $this->assertEquals(200, $response->getStatusCode());
        
    }
}
