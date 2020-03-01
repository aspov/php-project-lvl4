<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\TaskStatus;
use App\User;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAuth()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertRedirect(route('login'));
    }

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $taskStatus = factory(TaskStatus::class)->create();
        $response = $this->actingAs($user)->get(route('task_statuses.index'));
        $response->assertStatus(200);
        $response->assertSee($taskStatus->name);
    }

    public function testCreate()
    {
        $user = factory(User::class)->create();
        $taskStatus = factory(TaskStatus::class)->create();
        $response = $this->actingAs($user)->get(route('task_statuses.create'));
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $user = factory(User::class)->make();
        $taskStatus = factory(TaskStatus::class)->create();
        $response = $this->actingAs($user)->json('POST', route('task_statuses.store'), [
            'name' => $taskStatus->name
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('task_statuses', ['name' => $taskStatus->name]);
    }

    public function testShow()
    {
        $user = factory(User::class)->create();
        $taskStatus = factory(TaskStatus::class)->create();
        $response = $this->actingAs($user)->get(route('task_statuses.show', $taskStatus));
        $response->assertStatus(200);
        $response->assertSee($taskStatus->name);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $taskStatus = factory(TaskStatus::class)->create();
        $response = $this->actingAs($user)->json('PUT', route('task_statuses.update', $taskStatus), [
            'name' => $taskStatus->name
        ]);
        $response->assertStatus(302);
        $statusForUpdate = factory(TaskStatus::class)->make();
        $response = $this->actingAs($user)->json('PUT', route('task_statuses.update', $taskStatus), [
            'name' => $statusForUpdate->name
        ]);
        $response->assertStatus(302);
        $savedStatus = TaskStatus::find($taskStatus->id);
        $this->assertEquals($statusForUpdate->name, $savedStatus->name);
    }

    public function testDestroy()
    {
        $user = factory(User::class)->create();
        $taskStatus = factory(TaskStatus::class)->create();
        $response = $this->actingAs($user)->delete(route('account.destroy', $taskStatus));
        $response->assertStatus(302);
        $deletedStatus = User::find($user->id);
        $this->assertNull($deletedStatus);
    }
}
