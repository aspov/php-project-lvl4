<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Task;

class TaskControllerTest extends TestCase
{
    public function testAuth()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertRedirect(route('login'));
    }

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $response = $this->actingAs($user)->get(route('tasks.index'), ['filter' => ['myTask' => true]]);
        $response->assertStatus(200);
        $tasks = $response->viewData('tasks');
        $this->assertTrue(count($tasks) > 0);
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
        $taskData = \Arr::only($task->toArray(), ['name', 'status_id', 'assigned_to_id']);
        $response = $this->actingAs($user)->post(route('tasks.store'), $taskData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $taskData);
    }

    public function testShow()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $response = $this->actingAs($user)->get(route('tasks.show', $task));
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $updatedTask = factory(Task::class)->make();
        $updatedTaskData = \Arr::only($updatedTask->toArray(), ['name', 'status_id', 'assigned_to_id']);
        $response = $this->actingAs($user)->patch(route('tasks.update', $task), $updatedTaskData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.edit', $task));
        $this->assertDatabaseHas('tasks', $updatedTaskData);
    }

    public function testDestroy()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $response = $this->actingAs($user)->delete(route('tasks.destroy', $task));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id', $task->id]);
    }
}
