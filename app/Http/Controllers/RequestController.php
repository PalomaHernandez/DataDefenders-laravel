<?php

namespace App\Http\Controllers;

use App\Actions\ChangeRequestStatus;
use App\Contracts\RequestRepository;
use App\Exceptions\TransitionNotAllowedException;
use App\Models\JobOffer;
use App\Models\Request;
use App\Models\ScholarshipOffer;
use App\Patterns\State\Request\RequestStatus;
use InvalidArgumentException;

class RequestController extends Controller {

	public function __construct(private readonly RequestRepository $repository){}

	public function index(){
		$requests = $this->repository->getAllPendingPaginated();
		return view('admin.requests.index', compact('requests'));
	}

	public function edit(Request $request){
		return view('admin.requests.edit', compact('request'));
	}

	public function document_confirm(Request $request){
		return view('admin.requests.document', compact('request'));
	}

	public function document(Request $request){
		try {
			$this->commentAndTransition($request, RequestStatus::Documentation);
			return $this->returnToIndex($request);
		} catch(InvalidArgumentException|TransitionNotAllowedException $exception){
			return back()->withErrors($exception->getMessage());
		}
	}

	public function accept_confirm(Request $request){
		return view('admin.requests.accept', compact('request'));
	}

	public function accept(Request $request){
		try {
			$this->commentAndTransition($request, RequestStatus::Accepted);
			return $this->returnToIndex($request);
		} catch(InvalidArgumentException|TransitionNotAllowedException $exception){
			return back()->withErrors($exception->getMessage());
		}
	}

	public function reject_confirm(Request $request){
		return view('admin.requests.reject', compact('request'));
	}

	public function reject(Request $request){
		try {
			$this->commentAndTransition($request, RequestStatus::Rejected);
			return $this->returnToIndex($request);
		} catch(InvalidArgumentException|TransitionNotAllowedException $exception){
			return back()->withErrors($exception->getMessage());
		}
	}

	/**
	 * @throws InvalidArgumentException|TransitionNotAllowedException
	 */
	private function commentAndTransition(Request $request, RequestStatus $status){
		ChangeRequestStatus::execute($request, $status);
		if(request()->has('comments') && !is_null(request('comments'))){
			$request->comments()->create(request()->validate([
				'comments' => ['string', 'required']
			]));
		}
	}

	private function returnToIndex(Request $request){
		if($request->offer_type == JobOffer::class){
			return redirect()->route('requests.job.index');
		}
		if($request->offer_type == ScholarshipOffer::class){
			return redirect()->route('requests.scholarship.index');
		}
		return redirect()->route('requests.index');
	}

}
