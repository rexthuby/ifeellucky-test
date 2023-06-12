<?php

namespace Http\Controllers;

 use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\AccessKey;
use App\Models\User;
use Tests\TestCase;

class AccessKeyControllerTest extends TestCase
{
    use RefreshDatabase;
    private $baseRoute = '/api/v1';

    private string $key;
    protected function setUp(): void
    {
        parent::setUp();

        User::factory()->create();
        $result = AccessKey::factory()->create();
        $this->key = $result->key;
    }
    /**
     * A basic test example.
     */
    public function test_access_controller_show_status_200(): void
    {
        $response = $this->post($this->baseRoute.'/access-key',['key'=>$this->key]);
        $response->assertStatus(200);
    }

    public function test_access_controller_update_status_200(): void
    {
        $response = $this->put($this->baseRoute.'/access-key',['key'=>$this->key]);
        $response->assertStatus(200);
    }

    public function test_access_controller_delete_status_200(): void
    {
        $response = $this->delete($this->baseRoute.'/access-key',['key'=>$this->key]);
        $response->assertStatus(200);
    }
}
