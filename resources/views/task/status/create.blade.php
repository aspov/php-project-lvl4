@extends('task.menu')
@section('menu_content')
<form method="POST" action="{{ route('task_statuses.store') }}">
@csrf

<div class="form-group  row">
    <label for="name" class="col-md-1 col-form-label text-md-left">{{ __('Name') }}</label>

    <div class="col-md-4">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@error('name'){{ old('name') }}@enderror" required autocomplete="name" autofocus>

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

</div>

@endsection