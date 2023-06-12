<?php

namespace Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;
    private $baseRoute = '/api/v1';

    /**
     * A basic test example.
     */
    public function test_register_controller_status_200(): void
    {
        $userData = ['username'=>'test_user', 'phone_number'=>'38099666771'];
        $response = $this->post($this->baseRoute.'/register',$userData);

        $response->assertStatus(200);
    }
}
