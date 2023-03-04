<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewPlayerTest extends TestCase
{
    /**
     * @test
     */
    public function player_can_be_created(): void
    {
        // uniqid() to return random strings in every test
        // 
        $response = $this->post('/api/players', [
            'name' => uniqid(),
            'email' => uniqid(),
            'password' => uniqid(),
        ]);

        $this->assertEquals(201, $response->getStatusCode());
    }
}
