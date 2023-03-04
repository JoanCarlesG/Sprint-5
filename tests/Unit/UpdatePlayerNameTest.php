<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePlayerNameTest extends TestCase
{
    /**
     * @test
     */
    public function name_can_be_updated(): void
    {
        $user = User::factory()->create();
        
        $token = $user->createToken('example ')->accessToken;
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('/api/players/' . $user->id, [
            'name' => uniqid(),
        ]);
        
        $this->assertEquals(200, $response->getStatusCode());
        
    }
}
