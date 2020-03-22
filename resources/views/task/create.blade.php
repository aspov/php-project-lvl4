@extends('task.menu')
@section('menu_content')
<div class="card-body">
<form method="POST" action="{{ route('tasks.store') }}">    
    @csrf
    <div class="form-group row">
        <label for="name" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('Name') }}</label>

        <div class="col-md-4">
            <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="{{ __('New name') }}" name="name" value="{{ old('name') }}" required >           
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="status_id" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('Status') }}</label>
        <div class="col-md-4">            
            <select id="status_id" class="form-control form-control-sm @error('status_id') is-invalid @enderror" name="status_id" required>
                @foreach ($taskStatuses as $taskStatus)
                    <option
                    @error('status_id')
                        @if ($taskStatus->name == old('status')) selected value ="{{ $taskStatus->id }}" @endif                        
                    @else
                        @if (old('status_id'))
                            selected 
                        @elseif (old('status_id') == null and $taskStatus->id == $defaultTaskStatus->id)
                            selected 
                        @endif    
                        value ="{{ $taskStatus->id }}"                      
                    @enderror> {{ $taskStatus->name }}</option>                        
                @endforeach
            </select>  

            @error('status_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>    

    <div class="form-group  row">
    <label for="assigned_to_id" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('AssignedTo') }}</label>
        <div class="col-md-4">            
            <select id="assigned_to_id" class="form-control form-control-sm @error('assigned_to_id') is-invalid @enderror" name="assigned_to_id" required>
                @foreach ($users as $user)
                    <option value ="{{ $user->id }}">{{ $user->name }}</option>      
                @endforeach 
            </select>
            @error('assigned_to_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>   

    <div class="form-group row">
        <label for="description" class="col-md-2 col-form-label col-form-label-sm text-md-left">{{ __('Description') }}</label>
        <div class="col-md-4">
            <input id="description" type="text" class="form-control form-control-sm @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}">

            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>   
             
    <button type="submit" class="btn btn-primary mt-2">
        {{ __('Add') }}
    </button>    
</form>
</div>
@endsection

