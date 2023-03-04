<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetBestPlayerTest extends TestCase
{
    /**
     * @test
     */
    public function best_player_can_be_retrieved(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('example ')->accessToken;
        //remember to migrate first to have Roles in DB.
        $user->assignRole('Admin');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/players/ranking/winner');
        
        $response->assertStatus(200);
    }
}
