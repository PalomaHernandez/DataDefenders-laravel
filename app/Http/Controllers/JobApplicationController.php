<?php

namespace App\Http\Controllers;

use App\Contracts\ApplicationRepository;

class JobApplicationController extends Controller {

	public function __construct(private readonly ApplicationRepository $repository){}

	public function index(){
		$applications = $this->repository->getAllPendingPaginated();
		return view('admin.applications.job.index', compact('applications'));
	}

	public function all(){
		return response()->json($this->repository->getAll());
	}

	public function pending(){
		return response()->json($this->repository->getAllPending());
	}

	public function documentation(){
		return response()->json($this->repository->getAllDocumentation());
	}

	public function accepted(){
		return response()->json($this->repository->getAllAccepted());
	}

	public function rejected(){
		return response()->json($this->repository->getAllRejected());
	}

	public function allPaginated(){
		return response()->json($this->repository->getAllPaginated());
	}

	public function pendingPaginated(){
		return response()->json($this->repository->getAllPendingPaginated());
	}

	public function documentationPaginated(){
		return response()->json($this->repository->getAllDocumentationPaginated());
	}

	public function acceptedPaginated(){
		return response()->json($this->repository->getAllAcceptedPaginated());
	}

	public function rejectedPaginated(){
		return response()->json($this->repository->getAllRejectedPaginated());
	}

}
