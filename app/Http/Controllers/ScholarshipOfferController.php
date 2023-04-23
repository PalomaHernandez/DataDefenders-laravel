<?php

namespace App\Http\Controllers;

use App\Exceptions\OfferHasAtLeastOneRequestException;
use App\Models\ScholarshipOffer;
use Throwable;

class ScholarshipOfferController extends Controller {

	public function index(){
		$offers = ScholarshipOffer::all();
		return view('admin.offers.scholarship.index', compact('offers'));
	}

	public function create(){
		return view('admin.offers.scholarship.create');
	}

	public function store(){
		try {
			ScholarshipOffer::create(request()->validate([
				'title'        => ['string', 'max:255', 'required'],
				'description'  => ['string', 'required'],
				'requirements' => ['string', 'required'],
				'starts_at'    => ['date', 'required', 'after_or_equal:today'],
				'ends_at'      => ['date', 'required', 'after_or_equal:starts_at'],
				'visible'      => ['boolean', 'nullable'],
			]));
			return redirect()->route('scholarship.index')->with([
				'success' => 'The scholarship offer was created successfully.'
			]);
		} catch(Throwable $throwable){
			return back()->withInput()->with([
				'error' => $throwable->getMessage()
			]);
		}
	}

	public function edit(ScholarshipOffer $offer){
		return view('admin.offers.scholarship.edit', compact('offer'));
	}

	public function toggle(ScholarshipOffer $offer){
		$offer->update([
			'visible' => !$offer->visible
		]);
		return back();
	}

	public function update(ScholarshipOffer $offer){
		try {
			$offer->update(request()->validate([
				'title'        => ['string', 'max:255'],
				'description'  => ['string', 'required'],
				'requirements' => ['string', 'required'],
				'starts_at'    => ['date', 'required', 'after_or_equal:today'],
				'ends_at'      => ['date', 'required', 'after_or_equal:starts_at'],
				'visible'      => ['boolean', 'nullable'],
			]));
			return redirect()->route('scholarship.index')->with([
				'success' => 'The scholarship offer was updated successfully.'
			]);
		} catch(Throwable $throwable){
			return back()->withInput()->with([
				'error' => $throwable->getMessage()
			]);
		}
	}

	public function delete_confirm(ScholarshipOffer $offer){
		try {
			if($offer->requests()->exists()){
				throw new OfferHasAtLeastOneRequestException();
			}
			return view('admin.offers.scholarship.delete', compact('offer'));
		} catch(OfferHasAtLeastOneRequestException $exception){
			abort(403, $exception->getMessage());
		}
	}

	public function delete(ScholarshipOffer $offer){
		try {
			if($offer->requests()->exists()){
				throw new OfferHasAtLeastOneRequestException();
			}
			$offer->delete();
			return redirect()->route('scholarship.index')->with([
				'success' => 'The scholarship offer was deleted successfully.'
			]);
		} catch(OfferHasAtLeastOneRequestException $exception){
			abort(403, $exception->getMessage());
		}
	}

}
