<?php

namespace App\Http\Controllers;

use App\Exceptions\OfferHasAtLeastOneRequestException;
use App\Models\ScholarshipOffer;
use Illuminate\Validation\ValidationException;

class ScholarshipOfferController extends Controller {

	public function index(){
		$offers = ScholarshipOffer::withCount('applications')->latest()->paginate();
		return view('admin.offers.scholarship.index', compact('offers'));
	}

	public function all(){
		return response()->json(ScholarshipOffer::latest()->get());
	}

	public function allPaginated(){
		return response()->json(ScholarshipOffer::latest()->paginate());
	}

	public function find(int $offerId){
		return response()->json(ScholarshipOffer::findOrFail($offerId));
	}

	public function create(){
		return view('admin.offers.scholarship.create');
	}

	public function store(){
		ScholarshipOffer::create(request()->validate([
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

	public function edit(ScholarshipOffer $offer){
		return view('admin.offers.scholarship.edit', compact('offer'));
	}

	public function update(ScholarshipOffer $offer){
		$offer->update(request()->validate([
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

	public function delete_confirm(ScholarshipOffer $offer){
		try {
			if($offer->applications()->exists()){
				throw new OfferHasAtLeastOneRequestException();
			}
			return view('admin.offers.scholarship.delete', compact('offer'));
		} catch(OfferHasAtLeastOneRequestException $exception){
			throw ValidationException::withMessages([
				$exception->getMessage()
			]);
		}
	}

	public function delete(ScholarshipOffer $offer){
		try {
			if($offer->applications()->exists()){
				throw new OfferHasAtLeastOneRequestException();
			}
			$offer->delete();
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