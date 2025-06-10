<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class LogoutTest extends TestCase
{
    /** @test */
    public function user_can_logout(){
        $user = User::factory()->create();
        $this->actingAs($user);$response = $this->post('/logout');
        $this->assertGuest();
    }
}
