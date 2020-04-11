@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">    
        <div class="card-header">{{ __('New status') }}</div>    
        <div class="card-body">
            {{ Form::open(['url' => route('task_statuses.store'), 'method' => 'post']) }}
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
            {{ Form::submit(__('Add'), ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </div>
    </div>
</div> 
@endsection