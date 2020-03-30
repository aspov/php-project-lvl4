@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">    
        <div class="card-header">{{ __('Tasks') }}</div>    
        <div class="card-body">

            <div class="row">
                <div class="col-sm-2">{{ __('Name') }}: </div>
                <div class="col-sm">{{ $task->name }}</div>
            </div>
            <div class="row">
                <div class="col-sm-2">{{ __('Status') }}: </div>
                <div class="col-sm">{{ $task->status->name }}</div>
            </div> 
            <div class="row">
                <div class="col-sm-2">{{ __('Creator') }}: </div>
                <div class="col-sm">{{ $task->creator->name }}</div>
            </div>  
            <div class="row">
                <div class="col-sm-2">{{ __('AssignedTo') }}: </div>
                <div class="col-sm">{{ $task->assignedTo->name }}</div>
            </div>  
            <div class="row">
                <div class="col-sm-2">{{ __('Created_at') }}: </div>
                <div class="col-sm">{{ $task->created_at }}</div>
            </div>
            <div class="row">
                <div class="col-sm-2">{{ __('Updated_at') }}: </div>
                <div class="col-sm">{{ $task->updated_at }}</div>
            </div> 
            <div class="row">
                <div class="col-sm-2">{{ __('Descripton') }}: </div>
                <div class="col-sm">{{ $task->description }}</div>
            </div>
            <div class="row">
                <div class="col-sm-2">{{ __('Tags') }}: </div>
                <div class="col-sm">
                        @foreach ($task->tags as $tag)                            
                            {{ $tag->name }}                           
                        @endforeach
                </div>
            </div>            
            <a class="btn btn-primary mt-2" href="{{ route('tasks.edit', $task) }}" data-method="get" rel="nofollow">{{ __('Edit') }}</a>
            <a class="btn btn-primary mt-2" href="{{ route('tasks.destroy', $task) }}" data-confirm="{{ __('Are you sure?') }}" data-method="delete" rel="nofollow">{{ __('Delete') }}</a>   
        </div>
    </div>    
</div> 
@endsection