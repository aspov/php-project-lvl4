@extends('task.menu')
@section('menu_content')
<div class="card-body"> 
    <a class="btn btn-primary" href="{{ route('task_statuses.create') }}"  data-method="get" rel="nofollow">{{ __('Add new') }}</a> 
</div>	
@endsection

@section('results')
<div class="pt-1">
	<div class="card">	
		<div class="card-body">
			<div class="list-group list-group-flush"> 
				@foreach ($taskStatuses as $taskStatus)                
						<a href="{{ route('task_statuses.edit', $taskStatus) }}" class="list-group-item-action p-2">{{ $taskStatus->name }}</a> 
				@endforeach                     
			</div>
		</div>  
	</div>
</div>
<div class="pt-1">
		{{ $taskStatuses->links() }}
</div>
@endsection