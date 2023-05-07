<?php

namespace App\Http\Controllers;

use App\Exceptions\DepartmentHasAtLeastOneMajorException;
use App\Models\Department;
use App\Exceptions\DepartmentHasAtLeastOneOfferException;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller {

	public function index(){
		$departments = Department::latest()->paginate();
		return view('admin.departments.index', compact('departments'));
	}

	public function create(){
		return view('admin.departments.create');
	}

	public function store(){
		Department::create(request()->validate([
			'name' => ['string', 'max:255', 'unique:departments,name', 'required']
		]));
		return redirect()->route('departments.index')->with([
			'success' => 'The department was created successfully.'
		]);
	}

	public function find(int $departmentId){
		return response()->json(Department::findOrFail($departmentId));
	}

	public function edit(Department $department){
		return view('admin.departments.edit', compact('department'));
	}

	public function update(Department $department){
		if(request()->has('name') && request('name') != $department->name){
			$department->update(request()->validate([
				'name' => ['string', 'max:255', 'unique:departments,name', 'required']
			]));
		}
		return redirect()->route('departments.index')->with([
			'success' => 'The department was updated successfully.'
		]);
	}

	public function delete_confirm(Department $department){
		try {
			if($department->majors()->exists()){
				throw new DepartmentHasAtLeastOneMajorException();
			}
			if($department->jobOffers()->exists()){
				throw new DepartmentHasAtLeastOneOfferException();
			}
			return view('admin.departments.delete', compact('department'));
		} catch(DepartmentHasAtLeastOneMajorException|DepartmentHasAtLeastOneOfferException $exception){
			throw ValidationException::withMessages([
				$exception->getMessage()
			]);
		}
	}

	public function delete(Department $department){
		try {
			if($department->majors()->exists()){
				throw new DepartmentHasAtLeastOneMajorException();
			}
			if($department->jobOffers()->exists()){
				throw new DepartmentHasAtLeastOneOfferException();
			}
			$department->delete();
			return redirect()->route('departments.index')->with([
				'success' => 'The department was deleted successfully.'
			]);
		} catch(DepartmentHasAtLeastOneMajorException|DepartmentHasAtLeastOneOfferException $exception){
			throw ValidationException::withMessages([
				$exception->getMessage()
			]);
		}
	}

}
