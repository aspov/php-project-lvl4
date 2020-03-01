@extends('task.menu')
@section('menu_content')
<div class="pb-2"> 
        <a class="btn btn-primary" href="{{ route('task_statuses.create') }}"  data-method="get" rel="nofollow">Add new</a>               
</div>

<div class="list-group list-group-flush"> 
        @foreach ($taskStatuses as $taskStatus)                
                <a href="{{ route('task_statuses.show', $taskStatus) }}" class="list-group-item-action p-2">{{ $taskStatus->name }}</a> 
        @endforeach                     
</div>
@endsection

@section('pagination')
    <div class="pt-1">
        {{ $taskStatuses->links() }}
    </div>  
@endsection