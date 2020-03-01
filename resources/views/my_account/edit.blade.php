@extends('my_account.menu')

@section('account')
<form method="POST" action="{{ route('account.update', Auth::user()->name) }}">
    @method('PUT')
    @csrf

    <div class="form-group  row">
        <label for="name" class="col-md-2 col-form-label text-md-left">{{ __('Name') }}</label>

        <div class="col-md-4">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@error('name'){{ old('name') }}@else{{ Auth::user()->name }}@enderror" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-2 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

        <div class="col-md-4">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@error('email'){{ old('email') }}@else{{ Auth::user()->email }}@enderror" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
        
    <button type="submit" class="btn btn-primary mt-2">
        {{ __('Save') }}
    </button>

</form>
@endsection
