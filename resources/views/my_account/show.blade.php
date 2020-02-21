@extends('my_account.menu')
@section('account')
    <div class="card-text">Name: {{ Auth::user()->name }}</div>
    <div class="card-text">Created: {{ Auth::user()->created_at }}</div> 
    <a class="btn btn-primary mt-4" href="{{ route('account.destroy', Auth::user()->name) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>    
@endsection

