@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">    
        <div class="card-header">{{ __('New status') }}</div>    
        <div class="card-body"> 
            <form method="POST" action="{{ route('task_statuses.store') }}">
                @csrf
                <div class="form-group  row">
                    <label for="name" class="col-md-1 col-form-label text-md-left">{{ __('Name') }}</label>
                    <div class="col-md-4">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@error('name'){{ old('name') }}@enderror" required autofocus>
                        @error('name')
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
    </div>
</div> 
@endsection







@section('menu_content')

@endsection