@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">    
        <div class="card-header">{{ __('Tasks') }}</div>    
        <div class="card-body"> 
            <form method="GET" action="{{ route('tasks.index') }}">       
                @csrf
                <div class="form-group row">
                    <label for="tag" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('Tag') }}</label>
                    <div class="col-md-4">
                        <input id="tag" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="filter[tags.name]" value="{{ request()->filter['tags.name'] ?? ''  }}">                                  
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status_id" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('Status') }}</label>
                    <div class="col-md-4">            
                        <select id="status_id" class="form-control form-control-sm" name="filter[status_id]">
                            <option value="">Choose...</option> 
                            @foreach ($taskStatuses as $taskStatus)
                                <option 
                                @if ($taskStatus->id == (request()->filter['status_id'] ?? '')) selected @endif
                                value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>      
                            @endforeach 
                        </select>
                    </div>
                </div>

                <div class="form-group  row">
                <label for="assigned_to_id" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('AssignedTo') }}</label>
                    <div class="col-md-4">            
                        <select id="assigned_to_id" class="form-control form-control-sm" name="filter[assigned_to_id]">
                            <option value="">Choose...</option> 
                            @foreach ($users as $user)
                                <option 
                                @if ($user->id == (request()->filter['assigned_to_id'] ?? '')) selected @endif
                                value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach 
                        </select>
                    </div>
                </div>
                
                <div class="form-check">
                    <input type="checkbox" name="filter[creator_id]" class="form-check-input" value="{{ Auth::user()->id }}" id="myTask" @if (request()->filter['creator_id'] ?? '') checked @endif>
                    <label class="form-check-label" for="myTask">{{ __('My tasks') }}</label>
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
                <div class="container">
                    <div class="row font-weight-bold">
                        <div class="col-sm">{{ __('Name') }}</div>
                        <div class="col-sm">{{ __('Status') }}</div>
                        <div class="col-sm">{{ __('Creator') }}</div>
                        <div class="col-sm">{{ __('Created at') }}</div>
                        <div class="col-sm">{{ __('Assigned to') }}</div>
                        <div class="col-sm">{{ __('Tags') }}</div>
                    </div>                                                
                    @foreach ($tasks as $task)
                        <div class="row">
                            <div class="col-sm"><a href="{{ route('tasks.show', $task) }}"> {{ $task->name }} </a></div>  
                            <div class="col-sm">{{ $task->status->name }}</div> 
                            <div class="col-sm"><a href="{{ route('users.show', $task->creator) }}"> {{ $task->creator->name }} </a></div> 
                            <div class="col-sm">{{ $task->created_at }}</div> 
                            <div class="col-sm"><a href="{{ route('users.show', $task->assignedTo) }}"> {{ $task->assignedTo->name }} </a></div> 
                            <div class="col-sm">
                                @foreach ($task->tags as $tag)                                        
                                    {{ $tag->name }}                                         
                                @endforeach 
                            </div>
                        </div>
                    @endforeach
                    @if (count($tasks) == 0)                    
                        <div class="text-center pt-3">{{ __('Not found') }}</div>                        
                    @endif
                </div>
            </div>            
        </div>
    </div> 
    <div class="pt-1">
        {{ $tasks->links() }}
    </div>  
</div> 
@endsection