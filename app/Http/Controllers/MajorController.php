<?php

namespace App\Http\Controllers;

use App\Exceptions\MajorHasAtLeastOneOfferException;
use App\Models\Department;
use App\Models\Major;
use Illuminate\Validation\ValidationException;
use Throwable;

class MajorController extends Controller {

	public function index(){
		$departments = Department::paginate();
		return view('admin.majors.index', compact('departments'));
	}

	public function create(Department $department){
		return view('admin.majors.create', compact('department'));
	}

	public function store(){
		Major::create(request()->validate([
			'name'          => ['string', 'max:255', 'unique:majors,name'],
			'department_id' => ['numeric', 'required', 'exists:departments,id']
		]));
		return redirect()->route('majors.index')->with([
			'success' => 'The major was created successfully.'
		]);
	}

	public function find(int $majorId){
		return response()->json(Major::findOrFail($majorId));
	}

	public function edit(Major $major){
		return view('admin.majors.edit', compact('major'));
	}

	public function update(Major $major){
		$major->update(request()->validate([
			'name' => ['string', 'max:255', 'unique:majors,name']
		]));
		return redirect()->route('majors.index')->with([
			'success' => 'The major was updated successfully.'
		]);
	}

	public function delete_confirm(Major $major){
		try {
			if($major->scholarshipOffers()->exists()){
				throw new MajorHasAtLeastOneOfferException();
			}
			return view('admin.majors.delete', compact('major'));
		} catch(MajorHasAtLeastOneOfferException $exception){
			throw ValidationException::withMessages([
				$exception->getMessage()
			]);
		}
	}

	public function delete(Major $major){
		try {
			if($major->scholarshipOffers()->exists()){
				throw new MajorHasAtLeastOneOfferException();
			}
			$major->delete();
			return redirect()->route('majors.index');
		} catch(MajorHasAtLeastOneOfferException $exception){
			throw ValidationException::withMessages([
				$exception->getMessage()
			]);
		}
	}

}
