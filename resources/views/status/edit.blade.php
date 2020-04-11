@extends('layouts.app')

@section('content')
<div class="container">   
    <div class="pt-1">
        <div class="card">
        <div class="card-header">{{ __('Edit status') }}</div>
            <div class="card-body">
                {{ Form::model($taskStatus, ['url' => route('task_statuses.update', $taskStatus), 'method' => 'put']) }}
                    <div class="form-group row">
                        {{ Form::label('name', __('Name'),  ['class' => 'col-md-1 col-form-label col-form-label-sm text-md-left']) }}            
                        <div class="col-md-4">
                            {{ Form::text('name', null, ['class' => 'form-control form-control-sm' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => __('New name')]) }}
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                        
                    </div>
                {{ Form::submit(__('Save'), ['class' => 'btn btn-primary']) }}
                <a class="btn btn-primary" href="{{ route('task_statuses.destroy', $taskStatus) }}" data-confirm="{{ __('Are you sure?') }}" data-method="delete" rel="nofollow">{{ __('Delete') }}</a>
                {{ Form::close() }}
            </div>               
        </div>
    </div>
</div> 
@endsection