<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Task;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class TaskTagController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $tag = \App\Tag::firstOrCreate(['name' => $request->tag]);
        $validator = \Validator::make(['tag' => $tag->id], [
            'tag' => Rule::unique('task_tag', 'tag_id')->where('task_id', $task->id)
        ])->validate();
        $task->tags()->attach($tag);
        return redirect()->route('tasks.show', compact('task'));
    }
   
    public function destroy(Task $task, Tag $tag)
    {
        //удаление тега у задачи
        $task->tags()->detach($tag);
        //удление самого тега если его нет задач с таким тегом
        if ($tag->tasks()->count() == 0) {
            $tag->delete();
        };
        #dd($tag->tasks()->count());
        return redirect()->route('tasks.show', compact('task'));
    }
}
