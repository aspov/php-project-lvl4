@extends('task.menu')
@section('menu_content')
	
<div class="card-body">
<hr>
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
    <div class="row mt-1">
        <div class="col-sm-2"> </div>
        <div class="col-sm"><a class="btn btn-primary" href="{{ route('tasks.edit', $task) }}" data-method="get" rel="nofollow">{{ __('Edit') }}</a></div>
    </div>
    
    <hr>
    <div class="row">
        <div class="col-12 col-sm-2">{{ __('Tags') }}: </div>
        <div class="col-sm">
            <form method="POST" action="{{ route('tasks.tags.store', $task) }}">
                @method('POST')
                @csrf
                <div class="form-group row"> 
                    <div class="col-md-1">                  
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add') }}
                        </button>
                    </div>
                    <div class="col-md-4">                   
                        <input type="text" class="form-control @error('tag') is-invalid @enderror" name="tag" value="@error('tag'){{ old('tag') }}@enderror" required>
                        @error('tag')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>               
            </form>
            <div class="d-flex flex-wrap">
                @foreach ($task->tags as $tag)
                    <div class="border border-primary rounded p-1 mr-1 mb-1" >
                        {{ $tag->name }} | <a href="{{ route('tasks.tags.destroy', [$task, $tag]) }}" data-method="delete" rel="nofollow">{{ __('Delete') }}</a>
                    </div> 
                @endforeach
            </div>
        </div>        
    </div>
</div>
@endsection