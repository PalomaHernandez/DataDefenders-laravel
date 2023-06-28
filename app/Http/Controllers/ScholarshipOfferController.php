<?php

namespace App\Http\Controllers;

use App\Actions\UploadDocumentation;
use App\Contracts\ApplicationRepository;
use App\Contracts\OfferRepository;
use App\Exceptions\OfferHasAtLeastOneRequestException;
use App\Traits\HandlesApplications;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ScholarshipOfferController extends Controller {

	use HandlesApplications;

	public function __construct(
		private readonly ApplicationRepository $applicationRepository,
		private readonly OfferRepository $offerRepository,
	){}

	public function index(){
		$offers = $this->offerRepository->paginatedWithApplicationCount();
		return view('admin.offers.scholarship.index', compact('offers'));
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
		return view('admin.offers.scholarship.create');
	}

	public function store(){
		$this->offerRepository->store(request()->validate([
			'title'        => ['string', 'max:255', 'required'],
			'description'  => ['string', 'required'],
			'requirements' => ['string', 'required'],
			'starts_at'    => ['date', 'required', 'after_or_equal:today'],
			'ends_at'      => ['date', 'required', 'after_or_equal:starts_at'],
			'public'       => ['boolean', 'nullable'],
		]));
		return redirect()->route('offers.scholarship.index')->with([
			'success' => 'The scholarship offer was created successfully.'
		]);
	}

	public function edit(int $offerId){
		$offer = $this->offerRepository->findById($offerId);
		return view('admin.offers.scholarship.edit', compact('offer'));
	}

	public function update(int $offerId){
		$this->offerRepository->update($offerId, request()->validate([
			'title'        => ['string', 'max:255'],
			'description'  => ['string', 'required'],
			'requirements' => ['string', 'required'],
			'starts_at'    => ['date', 'required'],
			'ends_at'      => ['date', 'required', 'after_or_equal:starts_at'],
			'public'       => ['boolean', 'nullable'],
		]));
		return redirect()->route('offers.scholarship.index')->with([
			'success' => 'The scholarship offer was updated successfully.'
		]);
	}

	public function apply(int $offerId):JsonResponse{
		UploadDocumentation::validate();
		request()->validate([
			'major_id' => ['numeric', 'nullable', 'exists:majors,id'],
			'comments' => ['string', 'nullable', 'max:65535']
		]);
		return $this->handleApplication($offerId);
	}

	public function delete_confirm(int $offerId){
		try {
			$offer = $this->offerRepository->deleteConfirm($offerId);
			return view('admin.offers.scholarship.delete', compact('offer'));
		} catch(OfferHasAtLeastOneRequestException $exception){
			throw ValidationException::withMessages([
				$exception->getMessage()
			]);
		}
	}

	public function delete(int $offerId){
		try {
			$this->offerRepository->delete($offerId);
			return redirect()->route('offers.scholarship.index')->with([
				'success' => 'The scholarship offer was deleted successfully.'
			]);
		} catch(OfferHasAtLeastOneRequestException $exception){
			throw ValidationException::withMessages([
				$exception->getMessage()
			]);
		}
	}

}
