<?php

namespace App\Http\Controllers;

use App\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $taskStatuses = TaskStatus::paginate(10);
        return view('status.index', compact('taskStatuses'));
    }

    public function create()
    {
        return view('status.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:task_statuses'
        ]);

        $taskStatus = new TaskStatus();
        $taskStatus->fill($request->all());
        $taskStatus->save();
        flash(__('Added'))->success();
        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        return view('status.edit', compact('taskStatus'));
    }
    
    public function update(Request $request, TaskStatus $taskStatus)
    {
        $this->validate($request, [
            'name' => 'required|unique:task_statuses'
        ]);
        $taskStatus->fill($request->all());
        $taskStatus->save();
        flash(__('Saved'))->success();
        return redirect()->route('task_statuses.index');
    }
  
    public function destroy(TaskStatus $taskStatus)
    {
        $taskStatus->delete();
        flash(__('Deleted'))->success();
        return redirect()->route('task_statuses.index');
    }
}
