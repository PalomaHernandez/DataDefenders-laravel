@if($request->isPending)
	<span class="badge badge-warning">Pending</span>
@elseif($request->needsDocumentation)
	<span class="badge badge-purple">Needs Documentation</span>
@elseif($request->isRejected)
	<span class="badge badge-danger">Rejected</span>
@elseif($request->isAccepted)
	<span class="badge badge-success">Accepted</span>
@endif