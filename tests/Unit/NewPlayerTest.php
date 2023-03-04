<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewPlayerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function player_can_be_created(): void
    {
        $response = $this->post('/api/players', [
            'name' => 'Test Player',
            'email' => 'test@test.com',
            'password' => 'password',
        ]);

        $player = User::latest()->first();
        
        $this->assertEquals($player->name, 'Test Player');
        $this->assertEquals($player->email, 'test@test.com');
        $this->assertEquals(201, $response->getStatusCode());
    }
}
