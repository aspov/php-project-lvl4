<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Task;
use App\TaskTag;
use App\TaskStatus;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index(Request $request)
    {
        //index
        $tag = Tag::where('name', $request->tag)->first();
        
        $users = User::orderBy('name')->get();
        $taskStatuses = TaskStatus::orderBy('name')->get();
        //default filter
        if (!$request->filter) {
            $tasks = Task::paginate(10);
            return view('task.index', compact('tasks', 'taskStatuses', 'users'));
        }
        //search
        $tasks = QueryBuilder::for(Task::class)
        ->allowedIncludes(['tags'])
        ->allowedFilters('status_id', 'assigned_to_id', 'tags.name', 'creator_id')
        ->paginate(10);
        return view('task.index', compact('tasks', 'taskStatuses', 'users'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $taskStatuses = TaskStatus::orderBy('name')->get();
        return view('task.create', compact('taskStatuses', 'users'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status_id' => 'required',
            'assigned_to_id' => 'required'
        ]);
        
        $task = new Task();
        $task->fill($request->all());
        $task->creator()->associate(\Auth::user());
        $task->save();

        //add task tags
        $tagsIDs = collect(explode(" ", $request->tags))->reduce(function ($carry, $item) {
            $tag = Tag::firstOrCreate(['name' => trim($item)]);
            $carry[] = $tag->id;
            return $carry;
        });
        $task->tags()->sync($tagsIDs);

        flash(__('Added'))->success();
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }
    
    public function edit(Task $task)
    {
        $this->authorize('edit-task', $task);
        $taskStatuses = TaskStatus::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        $tags = collect($task->tags()->get())->implode('name', ' ');
        return view('task.edit', compact('task', 'taskStatuses', 'users', 'tags'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update-task', $task);
        $task->fill($request->all());
        $task->save();

        //add task tags
        $tagsIDs = collect(explode(" ", $request->tags))->reduce(function ($carry, $item) {
            $tag = Tag::firstOrCreate(['name' => trim($item)]);
            $carry[] = $tag->id;
            return $carry;
        });
        $task->tags()->sync($tagsIDs);

        //update tags
        Tag::whereDoesntHave('tasks')->delete();
 
        flash(__('Saved'))->success();
        return redirect()->route('tasks.edit', $task);
    }
    
    public function destroy(Task $task)
    {
        $task->delete();
        //update tags
        Tag::whereDoesntHave('tasks')->delete();
        
        flash(__('Deleted'))->success();
        return redirect()->route('tasks.index');
    }
}
