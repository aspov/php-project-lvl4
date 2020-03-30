@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">    
        <div class="card-header">{{ __('Edit task') }}</div>    
        <div class="card-body">
            <form method="POST" action="{{ route('tasks.update', $task) }}"> 
                @method('PUT')   
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('Name') }}</label>
                    <div class="col-md-4">
                        <input id="name" type="text" class="form-control form-control-sm" placeholder="{{ __('new name') }}" name="name" value="{{ $task->name }}" required >           
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status_id" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('Status') }}</label>
                    <div class="col-md-4">            
                        <select id="status_id" class="form-control form-control-sm" name="status_id" required>
                            @foreach ($taskStatuses as $taskStatus)
                                <option                               
                                    @if (old('status_id'))
                                        selected 
                                    @elseif (old('status_id') == null and $taskStatus->id == $defaultTaskStatus->id)
                                        selected 
                                    @endif    
                                    value ="{{ $taskStatus->id }}"> {{ $taskStatus->name }}
                                </option>                        
                            @endforeach
                        </select>
                    </div>
                </div>    

                <div class="form-group  row">
                <label for="assigned_to_id" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('Assigned to') }}</label>
                    <div class="col-md-4">            
                        <select id="assigned_to_id" class="form-control form-control-sm" name="assigned_to_id" required>
                            @foreach ($users as $user)
                                <option value ="{{ $user->id }}">{{ $user->name }}</option>      
                            @endforeach 
                        </select>
                    </div>
                </div>   

                <div class="form-group row">
                    <label for="description" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('Description') }}</label>

                    <div class="col-md-4">
                        <input id="description" type="text" class="form-control form-control-sm " name="description" value="{{ $task->description }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tags" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('Tags') }}</label>
                    <div class="col-md-4">
                        <input id="tags" type="text" class="form-control form-control-sm" value="{{ $taskTags }}" name="tags" placeholder="{{  __('for example (one two three)') }}">                        
                    </div>
                </div>  
                        
                <button type="submit" class="btn btn-primary mt-2">
                    {{ __('Save') }}
                </button>
            </form>
        </div>
    </div>
</div> 
@endsection