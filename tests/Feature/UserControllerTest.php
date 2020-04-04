<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;

class UserControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get(route('users.index'));
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $user = factory(User::class)->create();
        $response = $this->get(route('users.show', $user));
        $response->assertStatus(200);
    }
}
