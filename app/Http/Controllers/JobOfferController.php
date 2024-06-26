<?php

namespace App\Http\Controllers;

use App\Actions\UploadDocumentation;
use App\Contracts\ApplicationRepository;
use App\Contracts\OfferRepository;
use App\Exceptions\OfferHasAtLeastOneRequestException;
use App\Models\Department;
use App\Traits\HandlesApplications;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class JobOfferController extends Controller {

	use HandlesApplications;

	public function __construct(
		private readonly ApplicationRepository $applicationRepository,
		private readonly OfferRepository $offerRepository,
	){}

	public function index(){
		$offers = $this->offerRepository->paginatedWithApplicationCount();
		return view('admin.offers.job.index', compact('offers'));
	}

	public function all(){
		return response()->json($this->offerRepository->all());
	}

	public function allPaginated(){
		return response()->json($this->offerRepository->paginated());
	}

	public function find(int $offerId){
		return response()->json($this->offerRepository->findById($offerId));
	}

	public function create(){
		$departments = Department::orderBy('name')->latest()->get();
		return view('admin.offers.job.create', compact('departments'));
	}

	public function store(){
		$this->offerRepository->store(request()->validate([
			'title'         => ['string', 'max:255', 'required'],
			'description'   => ['string', 'required'],
			'requirements'  => ['string', 'required'],
			'starts_at'     => ['date', 'required', 'after_or_equal:today'],
			'ends_at'       => ['date', 'required', 'after_or_equal:starts_at'],
			'public'        => ['boolean'],
			'benefits'      => ['string', 'required'],
			'interview_at'  => ['date', 'required', 'after_or_equal:ends_at'],
			'department_id' => ['numeric', 'exists:departments,id', 'required'],
		]));
		return redirect()->route('offers.job.index')->with([
			'success' => 'The job offer was created successfully.'
		]);
	}

	public function edit(int $offerId){
		$departments = Department::all();
		$offer = $this->offerRepository->findById($offerId);
		return view('admin.offers.job.edit', compact('offer', 'departments'));
	}

	public function update(int $offerId){
		$this->offerRepository->update($offerId, request()->validate([
			'title'         => ['string', 'max:255', 'required'],
			'description'   => ['string', 'required'],
			'requirements'  => ['string', 'required'],
			'starts_at'     => ['date', 'required'],
			'ends_at'       => ['date', 'required', 'after_or_equal:starts_at'],
			'public'        => ['boolean'],
			'benefits'      => ['string', 'required'],
			'interview_at'  => ['date', 'required', 'after_or_equal:ends_at'],
			'department_id' => ['numeric', 'exists:departments,id', 'required'],
		]));
		return back()->with([
			'success' => 'The job offer was updated successfully.'
		]);
	}

	public function apply(int $offerId):JsonResponse{
		UploadDocumentation::validate();
		request()->validate([
			'comments' => ['string', 'nullable', 'max:65535']
		]);
		return $this->handleApplication($offerId);
	}

	public function delete_confirm(int $offerId){
		try {
			$offer = $this->offerRepository->deleteConfirm($offerId);
			return view('admin.offers.job.delete', compact('offer'));
		} catch(OfferHasAtLeastOneRequestException $exception){
			throw ValidationException::withMessages([
				$exception->getMessage()
			]);
		}
	}

	public function delete(int $offerId){
		try {
			$this->offerRepository->delete($offerId);
			return redirect()->route('offers.job.index');
		} catch(OfferHasAtLeastOneRequestException $exception){
			throw ValidationException::withMessages([
				$exception->getMessage()
			]);
		}
	}

}
