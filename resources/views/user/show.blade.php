@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('User account') }}</div>
        <div class="card-body">
            <div class="card-text">Name: {{ $user->name }}</div>
            <div class="card-text">Created: {{ $user->created_at }}</div>  
        </div>    
    </div>
</div>
@endsection