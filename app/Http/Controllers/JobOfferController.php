<?php

namespace App\Http\Controllers;

use App\Exceptions\OfferHasAtLeastOneRequestException;
use App\Models\Department;
use App\Models\JobOffer;
use Illuminate\Validation\ValidationException;

class JobOfferController extends Controller {

	public function index(){
		$offers = JobOffer::withCount('applications')->latest()->paginate();
		return view('admin.offers.job.index', compact('offers'));
	}

	public function all(){
		return response()->json(JobOffer::latest()->get());
	}

	public function allPaginated(){
		return response()->json(JobOffer::latest()->paginate());
	}

	public function find(int $offerId){
		return response()->json(JobOffer::findOrFail($offerId));
	}

	public function create(){
		$departments = Department::orderBy('name')->latest()->get();
		return view('admin.offers.job.create', compact('departments'));
	}

	public function store(){
		JobOffer::create(request()->validate([
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

	public function edit(JobOffer $offer){
		$departments = Department::all();
		return view('admin.offers.job.edit', compact('offer', 'departments'));
	}

	public function update(JobOffer $offer){
		$offer->update(request()->validate([
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

	public function delete_confirm(JobOffer $offer){
		try {
			if($offer->applications()->exists()){
				throw new OfferHasAtLeastOneRequestException();
			}
			return view('admin.offers.job.delete', compact('offer'));
		} catch(OfferHasAtLeastOneRequestException $exception){
			throw ValidationException::withMessages([
				$exception->getMessage()
			]);
		}
	}

	public function delete(JobOffer $offer){
		try {
			if($offer->applications()->exists()){
				throw new OfferHasAtLeastOneRequestException();
			}
			$offer->delete();
			return redirect()->route('offers.job.index');
		} catch(OfferHasAtLeastOneRequestException $exception){
			throw ValidationException::withMessages([
				$exception->getMessage()
			]);
		}
	}

}