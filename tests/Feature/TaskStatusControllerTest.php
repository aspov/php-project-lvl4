<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\TaskStatus;
use App\User;

class TaskStatusControllerTest extends TestCase
{
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
    }

    public function testCreate()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('task_statuses.create'));
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $user = factory(User::class)->create();
        $taskStatus = factory(TaskStatus::class)->make();
        $taskStatusData = \Arr::only($taskStatus->toArray(), ['name']);
        $response = $this->actingAs($user)->post(route('task_statuses.store'), $taskStatusData);
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', $taskStatusData);
    }

    public function testShow()
    {
        $user = factory(User::class)->create();
        $taskStatus = factory(TaskStatus::class)->create();
        $response = $this->actingAs($user)->get(route('task_statuses.edit', $taskStatus));
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $taskStatus = factory(TaskStatus::class)->create();
        $changedStatus = factory(TaskStatus::class)->make();
        $changedStatusData = \Arr::only($changedStatus->toArray(), ['name']);
        $response = $this->actingAs($user)->patch(route('task_statuses.update', $taskStatus), $changedStatusData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', $changedStatusData);
    }

    public function testDestroy()
    {
        $user = factory(User::class)->create();
        $taskStatus = factory(TaskStatus::class)->create();
        $response = $this->actingAs($user)->delete(route('task_statuses.destroy', $taskStatus));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', ['name', $taskStatus->name]);
    }
}
