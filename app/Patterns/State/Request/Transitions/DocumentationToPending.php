<?php

namespace App\Patterns\State\Request\Transitions;

use App\Contracts\RequestTransition;
use App\Exceptions\TransitionNotAllowedException;
use App\Models\Request;
use App\Patterns\State\Request\RequestStatus;

class DocumentationToPending implements RequestTransition {

	public function execute(Request $request):Request{
		if($request->status !== RequestStatus::Documentation){
			throw new TransitionNotAllowedException();
		}

		$request->update([
			'status' => RequestStatus::Pending
		]);

		return $request;
	}

}