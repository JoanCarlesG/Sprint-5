<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewGameTest extends TestCase
{
    /**
     * @test
     */
    public function game_can_be_created(): void
    {
        $user = User::factory()->create();
        User::newGame($user);
        $token = $user->createToken('example ')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('api/players/' . $user->id . '/games');
        //dd($response);
        $this->assertEquals(201, $response->getStatusCode());
    }
}
