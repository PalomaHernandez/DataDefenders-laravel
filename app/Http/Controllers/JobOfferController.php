<?php

namespace App\Http\Controllers;

use App\Exceptions\OfferHasAtLeastOneRequestException;
use App\Models\Department;
use App\Models\JobOffer;
use Throwable;

class JobOfferController extends Controller {

	public function index(){
		$offers = JobOffer::paginate();
		return view('admin.offers.job.index', compact('offers'));
	}

	public function create(){
		$departments = Department::all();
		return view('admin.offers.job.create', compact('departments'));
	}

	public function store(){
		try {
			JobOffer::create(request()->validate([
				'title' => ['string', 'max:255', 'required'],
				'description' => ['string', 'required'],
				'requirements' => ['string', 'required'],
				'starts_at' => ['date', 'required', 'after_or_equal:today'],
				'ends_at' => ['date', 'required', 'after_or_equal:starts_at'],
				'visible' => ['boolean', 'nullable'],
				'benefits' => ['string', 'required'],
				'interview_at' => ['date', 'required'],
				'department_id' => ['numeric', 'exists:departments,id', 'required'],
			]));
			return redirect()->route('departments.index')->with([
				'success' => 'The job offer was created successfully.'
			]);
		} catch(Throwable $throwable){
			return back()->withInput()->with([
				'error' => $throwable->getMessage()
			]);
		}
	}

	public function show(JobOffer $offer){
		return view('offers.job.show', compact('offer'));
	}

	public function edit(JobOffer $offer){
		$departments = Department::all();
		return view('admin.offers.job.edit', compact('offer', 'departments'));
	}

	public function update(JobOffer $offer){
		try {
			$offer->update(request()->validate([
				'title' => ['string', 'max:255', 'required'],
				'description' => ['string', 'required'],
				'requirements' => ['string', 'required'],
				'starts_at' => ['date', 'required', 'after_or_equal:today'],
				'ends_at' => ['date', 'required', 'after_or_equal:starts_at'],
				'visible' => ['boolean', 'nullable'],
				'benefits' => ['string', 'required'],
				'interview_at' => ['date', 'required'],
				'department_id' => ['numeric', 'exists:departments,id', 'required'],
			]));
			return redirect()->route('departments.index')->with([
				'success' => 'The job offer was updated successfully.'
			]);
		} catch(Throwable $throwable){
			return back()->withInput()->with([
				'error' => $throwable->getMessage()
			]);
		}
	}

	public function toggle(JobOffer $offer){
		$offer->update([
			'visible' => !$offer->visible
		]);
		return back();
	}

	public function delete_confirm(JobOffer $offer){
		try {
			if($offer->requests()->exists()){
				throw new OfferHasAtLeastOneRequestException();
			}
			return view('admin.offers.job.delete', compact('offer'));
		} catch(OfferHasAtLeastOneRequestException $exception){
			abort(403, $exception->getMessage());
		}
	}

	public function delete(JobOffer $offer){
		try {
			if($offer->requests()->exists()){
				throw new OfferHasAtLeastOneRequestException();
			}
			$offer->delete();
			return redirect()->route('admin.offers.job.index');
		} catch(OfferHasAtLeastOneRequestException $exception){
			return back()->with([
				'error' => $exception->getMessage()
			]);
		}
	}

}
