@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">    
        <div class="card-header">{{ __('Tasks') }}</div>    
        <div class="card-body"> 
            <form method="GET" action="{{ route('tasks.index') }}">       
                @csrf
                <div class="form-group row">
                    <label for="tag_id" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('Tag') }}</label>
                    <div class="col-md-4">
                        <select id="tag_id" class="form-control form-control-sm" name="tag_id">
                            <option value=""> {{ old('tag_id') }} Choose...</option> 
                            @foreach ($tags as $tag)
                                <option 
                                @if ($tag->id == request()->tag_id) selected @endif 
                                value="{{ $tag->id }}">{{ $tag->name }}</option>      
                            @endforeach 
                        </select>            
                    </div>
                </div>

                <div class="form-group  row">
                    <label for="status_id" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('Status') }}</label>
                    <div class="col-md-4">            
                        <select id="status_id" class="form-control form-control-sm" name="status_id">
                            <option value="">Choose...</option> 
                            @foreach ($taskStatuses as $taskStatus)
                                <option 
                                @if ($taskStatus->id == request()->status_id) selected @endif
                                value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>      
                            @endforeach 
                        </select>
                    </div>
                </div>

                <div class="form-group  row">
                <label for="assigned_to_id" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('AssignedTo') }}</label>
                    <div class="col-md-4">            
                        <select id="assigned_to_id" class="form-control form-control-sm" name="assigned_to_id">
                            <option value="">Choose...</option> 
                            @foreach ($users as $user)
                                <option 
                                @if ($user->id == request()->assigned_to_id) selected @endif
                                value="{{ $user->id }}">{{ $user->name }}</option>      
                            @endforeach 
                        </select>
                    </div>
                </div>
                
                <div class="form-check">
                    <input type="checkbox" name="myTasks" class="form-check-input" id="exampleCheck1" @if (request()->myTasks) checked @endif>
                    <label class="form-check-label" for="exampleCheck1">{{ __('My tasks') }}</label>
                </div>        
                    
                <button type="submit" class="btn btn-primary mt-3">
                    {{ __('Search') }}
                </button>
                <a class="btn btn-primary mt-3" href="{{ route('tasks.create') }}"  data-method="get" rel="nofollow">{{ __('Add new') }}</a>
            </form>
        </div>  
    </div> 
    <div class="pt-1">
        <div class="card">
            <div class="card-body">        
                <div class="table-responsive">
                    <table class="table table-sm table-hover">               
                        <thead>
                            <tr>
                                <th style="width: 20%">{{ __('Name') }}</th>                            
                                <th style="width: 10%">{{ __('Status') }}</th>
                                <th style="width: 10%">{{ __('Creator') }}</th>
                                <th style="width: 20%">{{ __('Created at') }}</th>
                                <th style="width: 10%">{{ __('Assigned to') }}</th>
                                <th style="width: 20%">{{ __('Tags') }}</th>                            
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($tasks as $task)          
                                <tr onclick="window.location.href= '{{ route('tasks.show', $task) }}'"> 
                                <a href="{{ route('tasks.show', $task) }}">               
                                    <td ><a href="{{ route('tasks.show', $task) }}"> {{ $task->name }} </a></td>
                                    <td> {{ $task->status->name }}</td>
                                    <td> <a href="{{ route('users.show', $task->creator) }}"> {{ $task->creator->name }} </a></td>
                                    <td> {{ $task->created_at }} </td>
                                    <td> <a href="{{ route('users.show', $task->assignedTo) }}"> {{ $task->assignedTo->name }} </a></td>                                
                                    <td> 
                                        @foreach ($task->tags as $tag)                                        
                                                {{ $tag->name }}                                         
                                        @endforeach 
                                    </td>
                                    </a>
                                </tr> 
                            @endforeach
                            @if (count($tasks) == 0)
                            <tr>               
                                <td >{{ __('Not found') }}</td>                                
                            </tr>                        
                            @endif 
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div> 
    <div class="pt-1">
        {{ $tasks->links() }}
    </div>  
</div> 
@endsection