@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Edit task') }}</div>    
        <div class="card-body">
            {{ Form::open(['url' => route('tasks.update', $task), 'method' => 'put']) }}
            <div class="form-group row">
                    {{ Form::label('name', __('Name'),  ['class' => 'col-md-2 col-form-label col-form-label-sm text-md-left']) }}            
                <div class="col-md-4">
                    {{ Form::text('name', $task->name, ['class' => 'form-control form-control-sm']) }}
                </div>
            </div>
            <div class="form-group row">            
                    {{ Form::label('status_id', __('Status'),  ['class' => 'col-md-2 col-form-label col-form-label-sm text-md-left']) }}            
                <div class="col-md-4">
                    {{ Form::select('status_id', $taskStatuses->pluck('name', 'id'), $task->status_id, ['class' => 'form-control form-control-sm']) }}
                </div>
            </div>
            <div class="form-group row">            
                    {{ Form::label('assigned_to_id', __('Assigned to'),  ['class' => 'col-md-2 col-form-label col-form-label-sm text-md-left']) }}            
                <div class="col-md-4">
                    {{ Form::select('assigned_to_id', $users->pluck('name', 'id'), $task->assigned_to_id, ['class' => 'form-control form-control-sm']) }}
                </div>
            </div>
            <div class="form-group row">
                    {{ Form::label('description', __('Description'),  ['class' => 'col-md-2 col-form-label col-form-label-sm text-md-left']) }}            
                <div class="col-md-4">
                    {{ Form::text('description', $task->description, ['class' => 'form-control form-control-sm']) }}
                </div>
            </div>
            <div class="form-group row">
                    {{ Form::label('tags', __('Tags'),  ['class' => 'col-md-2 col-form-label col-form-label-sm text-md-left']) }}            
                <div class="col-md-4">
                    {{ Form::text('tags', $task->tags->implode('name', ' '), ['class' => 'form-control form-control-sm']) }}
                </div>
            </div>
            {{ Form::submit(__('Save'), ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </div>
    </div>
</div> 
@endsection