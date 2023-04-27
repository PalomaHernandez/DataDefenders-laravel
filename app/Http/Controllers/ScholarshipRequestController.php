<?php

namespace App\Http\Controllers;

use App\Contracts\RequestRepository;

class ScholarshipRequestController extends Controller {

	public function __construct(private readonly RequestRepository $repository){}

	public function index(){
		$requests = $this->repository->getAllPendingPaginated();
		return view('admin.requests.scholarship.index', compact('requests'));
	}

}
