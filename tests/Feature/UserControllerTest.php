<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
   

    public function test_get_all_memcache()
    {
        $response = $this->withoutMiddleware();
        $response = $this->call('GET','/',);
        $response->assertStatus($response->status(), 302);

    }

    public function test_add_user()
    {
        $response = $this->withoutMiddleware();
        $response = $this->call('POST','/user',[
            'name'  =>  $name = 'Test',
            'email'  =>  $email = time().'test@example.com',
            'password'  =>  $password = '123456'
        ]);
        $response->assertStatus($response->status(), 302);
    }

    public function test_register_error(){
        $response = $this->post('/user', [
        'name' => 'Test User',
        'email' => 'test192S0@example.com',
        'password' => '123456'
        ]);
        $errorjson = [
        'success' => 'false',
        'message' => 'error',
        ];
        
        $response->assertStatus(500);
        }
}
