@extends('task.menu')
@section('menu_content')
<div class="card-body"> 
    <a class="btn btn-primary" href="{{ route('task_statuses.create') }}"  data-method="get" rel="nofollow">{{ __('Add new') }}</a>
</div> 
@endsection

@section('results')
<div class="pt-1">
	<div class="card">
		<div class="card-body">
        <div class="card-text pb-3"> {{ __('Edit') }} </div>
            <form method="POST" action="{{ route('task_statuses.update', $taskStatus) }}">
                @method('PUT')
                @csrf
                <div class="form-group row"> 
                    <div class="col-md-4">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $taskStatus->name }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">
                    {{ __('Save') }}
                </button>
                <a class="btn btn-primary mt-2" href="{{ route('task_statuses.destroy', $taskStatus) }}" data-confirm="{{ __('Are you sure?') }}" data-method="delete" rel="nofollow">{{ __('Delete') }}</a>
            </form>            
    </div>
</div>
@endsection