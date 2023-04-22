<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipOffer;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Throwable;

class ScholarshipOfferController extends Controller
{
    public function index(){
		$scholarshipoffers = ScholarshipOffer::all();
		return view('admin.scholarshipoffers.index', compact('scholarshipoffers'));
	}

    public function create(){
		return view('admin.scholarshipoffers.create');
	}

    public function store(){
		try {
			ScholarshipOffer::create(request()->validate([
				'title' => ['string', 'max:255', 'required'],
                'description' => ['string'],
                'requirements' => ['string'],
                'starts_at'=>['date','required','after_or_equal:today'],
                'ends_at'=>['date','required','after_or_equal:starts_at'],
                'visible'=>['boolean','nullable']
			]));
			return redirect()->route('scholarshipoffers.index')->with([
				'success' => 'The scholarship offer was created successfully.'
			]);
		} catch(Throwable $throwable){
			return back()->withInput()->with([
				'error' => $throwable->getMessage()
			]);
		}
	}

    public function edit(ScholarshipOffer $scholarshipoffer){
		return view('admin.scholarshipoffers.edit', compact('scholarshipoffer'));
	}

	public function update(ScholarshipOffer $scholarshipoffer){
		try {
			$scholarshipoffer->update(request()->validate([
				'title' => ['string', 'max:255']
			]));
			return redirect()->route('scholarshipoffers.index')->with([
				'success' => 'The scholarship offer was updated successfully.'
			]);
		} catch(Throwable $throwable){
			return back()->withInput()->with([
				'error' => $throwable->getMessage()
			]);
		}
	}

	public function delete(ScholarshipOffer $scholarshipoffer){
		$scholarshipoffer->delete();
		return redirect()->route('scholarshipoffers.index')->with([
			'success' => 'The scholarship offer was deleted successfully.'
		]);
	}

}
