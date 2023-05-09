@if($application->isPending)
	<span class="badge badge-warning">Pending</span>
@elseif($application->needsDocumentation)
	<span class="badge badge-purple">Needs Documentation</span>
@elseif($application->isRejected)
	<span class="badge badge-danger">Rejected</span>
@elseif($application->isAccepted)
	<span class="badge badge-success">Accepted</span>
@endif