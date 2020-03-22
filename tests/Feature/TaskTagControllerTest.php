<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Task;
use App\Tag;

class TaskTagControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStore()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $tag = factory(Tag::class)->create();
        $response = $this->actingAs($user)->post(route('tasks.tags.store', $task), [
            'tag' => $tag->name
        ]);
        $response->assertRedirect(route('tasks.show', $task));
        $this->assertDatabaseHas('task_tag', ['task_id' => $task->id, 'tag_id' => $tag->id]);
    }

    public function testDestroy()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();
        $tag = factory(Tag::class)->create();
        $response = $this->actingAs($user)->delete(route('tasks.tags.destroy', [$task, $tag]));
        $response->assertRedirect(route('tasks.show', $task));
        $this->assertDatabaseMissing('task_tag', [
            'task_id' => $task->id,
            'tag_id' => $tag->id
        ]);
        $this->assertDatabaseMissing('tags', ['name', $tag->name]);
    }
}
