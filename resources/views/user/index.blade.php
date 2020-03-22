@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="card"> 
        <div class="card-header">{{ __('Users') }}</div>
        <div class="list-group list-group-flush"> 
                @foreach ($users as $user)                
                        <a href="{{ route('users.show', $user) }}" class="list-group-item list-group-item-action">{{ $user->name }}</a> 
                @endforeach                     
        </div>
    </div>
    <div class="pt-1">
        {{ $users->links() }}
    </div>
</div>      
@endsection