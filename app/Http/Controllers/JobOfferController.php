<?php

namespace App\Http\Controllers;

use App\Actions\UploadDocumentation;
use App\Exceptions\OfferHasAtLeastOneRequestException;
use App\Models\Department;
use App\Models\JobOffer;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use PHPUnit\Exception;

class JobOfferController extends Controller {

	private array $with = [
		'department' => [
			'majors'
		]
	];

	public function index(){
		$offers = JobOffer::withCount('applications')->latest()->paginate();
		return view('admin.offers.job.index', compact('offers'));
	}

	public function all(){
		return response()->json(JobOffer::with($this->with)->latest()->get());
	}

	public function allPaginated(){
		return response()->json(JobOffer::with($this->with)->latest()->paginate());
	}

	public function find(int $offerId){
		return response()->json(JobOffer::with($this->with)->findOrFail($offerId));
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

	public function apply(JobOffer $offer){
		UploadDocumentation::validate();
		try {
			$application = $offer->applications()->create([
				'user_id' => request()->user()->id
			]);
			UploadDocumentation::execute($application);
			return response()->json([
				'res' => true,
				'text' => 'Applied successfully.'
			]);
		} catch(Exception $exception){
			Log::error($exception->getTraceAsString());
			return response()->json([
				'res' => false,
				'text' => 'Could not apply.'
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
