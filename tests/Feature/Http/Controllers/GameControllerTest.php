<?php

namespace Http\Controllers;

 use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\AccessKey;
use App\Models\GameResult;
use App\Models\User;
use Tests\TestCase;

class GameControllerTest extends TestCase
{
    use RefreshDatabase;
    private $baseRoute = '/api/v1';

    private string $key;
    protected function setUp(): void
    {
        parent::setUp();

        User::factory()->create();
        $accessKey = AccessKey::factory()->create();
        GameResult::factory(3)->create();
        $this->key = $accessKey->key;
    }
    /**
     * A basic test example.
     */
    public function test_game_controller_show_status_200(): void
    {
        $response = $this->post($this->baseRoute.'/game-history', ['key'=>$this->key]);

        $response->assertStatus(200);
    }

    public function test_game_controller_lucky_game_status_200(): void
    {
        $response = $this->post($this->baseRoute.'/lucky-game',['key'=>$this->key]);

        $response->assertStatus(201);
    }
}
