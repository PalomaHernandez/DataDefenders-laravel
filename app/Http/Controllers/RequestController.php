<?php

namespace App\Http\Controllers;

use App\Actions\ChangeRequestStatus;
use App\Models\JobOffer;
use App\Models\Request;
use App\Models\ScholarshipOffer;
use App\Patterns\State\Request\RequestStatus;
use App\Repositories\RequestRepository;
use Throwable;

class RequestController extends Controller {

	public function __construct(private readonly RequestRepository $repository){}

	public function index(){
		$requests = $this->repository->getByStatus(RequestStatus::Pending, true);
		return view('admin.requests.index', compact('requests'));
	}

	public function job(){
		$requests = $this->repository->getByOfferType(JobOffer::class, RequestStatus::Pending, true);
		return view('admin.requests.job.index', compact('requests'));
	}

	public function scholarship(){
		$requests = $this->repository->getByOfferType(ScholarshipOffer::class, RequestStatus::Pending, true);
		return view('admin.requests.scholarship.index', compact('requests'));
	}

	public function edit(Request $request){
		return view('admin.requests.edit', compact('request'));
	}

	public function document_confirm(Request $request){
		return view('admin.requests.document', compact('request'));
	}

	public function document(Request $request){
		try {
			ChangeRequestStatus::execute($request, RequestStatus::Documentation);
			$request->comments()->create(request()->validate([
				'comment' => ['string', 'required']
			]));
			return $this->determineRedirection($request);
		} catch(Throwable $exception){
			return back()->withErrors($exception->getMessage());
		}
	}

	public function accept_confirm(Request $request){
		return view('admin.requests.accept', compact('request'));
	}

	public function accept(Request $request){
		try {
			$this->commentNullableAndTransition($request, RequestStatus::Accepted);
			return $this->determineRedirection($request);
		} catch(Throwable $exception){
			return back()->withErrors($exception->getMessage());
		}
	}

	public function reject_confirm(Request $request){
		return view('admin.requests.reject', compact('request'));
	}

	public function reject(Request $request){
		try {
			$this->commentNullableAndTransition($request, RequestStatus::Rejected);
			return $this->determineRedirection($request);
		} catch(Throwable $exception){
			return back()->withErrors($exception->getMessage());
		}
	}

	/**
	 * @throws Throwable
	 */
	private function commentNullableAndTransition(Request $request, RequestStatus $status){
		ChangeRequestStatus::execute($request, $status);
		if(request()->has('comment')){
			$request->comments()->create(request()->validate([
				'comment' => ['string', 'nullable']
			]));
		}
	}

	private function determineRedirection(Request $request){
		if($request->offer_type == JobOffer::class){
			return redirect()->route('requests.job.index');
		}
		if($request->offer_type == ScholarshipOffer::class){
			return redirect()->route('requests.scholarship.index');
		}
		return redirect()->route('requests.index');
	}

}
