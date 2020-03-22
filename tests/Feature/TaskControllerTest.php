<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Task;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAuth()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertRedirect(route('login'));
    }

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $response = $this->actingAs($user)->get(route('tasks.index'));
        $response->assertStatus(200);
        $response->assertSee($task->name);
    }

    public function testCreate()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('tasks.create'));
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->make();
        $response = $this->actingAs($user)->json('POST', route('tasks.store'), [
            'name' => $task->name,
            'status_id' => $task->status_id,
            'assigned_to_id' => $task->assigned_to_id
        ]);
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['name' => $task->name]);
    }

    public function testShow()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $response = $this->actingAs($user)->get(route('tasks.show', $task));
        $response->assertStatus(200);
        $response->assertSee($task->name);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $changedTask = factory(Task::class)->make();
        $response = $this->actingAs($user)->json('PUT', route('tasks.update', $task), [
            'name' => $changedTask->name
        ]);
        $response->assertRedirect(route('tasks.edit', $task));
        $savedTask = Task::find($task->id);
        $this->assertEquals($changedTask->name, $savedTask->name);
    }

    public function testDestroy()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $response = $this->actingAs($user)->delete(route('tasks.destroy', $task));
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id', $task->id]);
    }
}
