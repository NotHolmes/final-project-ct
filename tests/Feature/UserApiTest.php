<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_user_from_api()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }

    public function test_register_user(){
        $response = $this->post('/api/auth/register', [
            'name' => 'testuser',
            'email' => 'teeza@example.com',
            'password' => 'testuserpass',
            ]);

        $response->assertStatus(201);
    }

    public function test_login_user()
    {
        $this->post('/api/auth/register', [
            'name' => 'testuser',
            'email' => 'teeza@example.com',
            'password' => 'testuserpass',
        ]);
        $response = $this->post('/api/auth/login', [
            'email' => 'teeza@example.com',
            'password' => 'testuserpass',
        ]);

        $response->assertStatus(200);
    }

    public function test_login_and_get_access_token(){
        $this->post('/api/auth/register', [
            'name' => 'testuser',
            'email' => 'teeza@example.com',
            'password' => 'testuserpass',
        ]);

        $response = $this->post('/api/auth/login', [
            'email' => 'teeza@example.com',
            'password' => 'testuserpass',
        ]);

        $response->assertStatus(200);
        $responseContent = $response->getContent();
        $accessToken = json_decode($responseContent)->access_token;
        $this->assertNotNull($accessToken);
    }

    public function test_login_without_user_in_database()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'asdsaddsadsa@example.com',
            'password' => 'testuserpass',
        ]);

        $response->assertStatus(401);
    }



}

