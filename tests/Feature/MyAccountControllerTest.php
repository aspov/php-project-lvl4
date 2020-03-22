<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class MyAccountControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAuth()
    {
        $response = $this->get(route('account.index'));
        $response->assertRedirect(route('login'));
    }

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('account.index'));
        $response->assertRedirect(route('account.show', $user->name));
    }

    public function testEdit()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('account.edit', $user));
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->json('PUT', route('account.update', $user), [
            'name' => $user->name,
            'email' => $user->email
        ]);
        $response->assertStatus(200);
        $changedUser = factory(User::class)->make();
        $response = $this->actingAs($user)->json('PUT', route('account.update', $user), [
            'name' => $changedUser->name,
            'email' => $changedUser->email,
        ]);
        $response->assertStatus(200);
        $response->assertSee($changedUser->name);
        $savedUser = User::find($user->id);
        $this->assertEquals($changedUser->name, $savedUser->name);
    }

    public function testDestroy()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->delete(route('account.destroy', $user));
        $response->assertStatus(302);
        $this->assertDatabaseMissing('users', ['id', $user->id]);
    }
}
