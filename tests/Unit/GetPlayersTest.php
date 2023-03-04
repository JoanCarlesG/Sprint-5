<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Contracts\Role;

class GetPlayersTest extends TestCase
{
    /**
     * @test
     */
    public function players_can_be_retrieved(): void
    {
        
        $user = User::factory()->create();
        $token = $user->createToken('example ')->accessToken;
        //migrate first to have Roles in DB.
        $user->assignRole('Admin');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/players');
        
        $response->assertStatus(200);
    }
}
