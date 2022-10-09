<?php

namespace Tests\Feature\Controllers;


use App\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_user(): void
    {
        $response = $this->getJson('/users');
        $response->assertStatus(200);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_edit(): void
    {
        $newUser = User::factory()->create();

        $response = $this->postJson('/users-edit', [
            'id' => $newUser->id,
            'name' => 'test name',
            'email' => 'msamvel32@mail.ru',
            'password' => '111'
        ]);

        $response->assertStatus(302);
    }
}
