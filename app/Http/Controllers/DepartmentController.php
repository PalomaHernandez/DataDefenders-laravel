<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Throwable;

class DepartmentController extends Controller {

	public function index(){
		$departments = Department::all();
		return view('admin.departments.index', compact('departments'));
	}

	public function create(){
		return view('admin.departments.create');
	}

	public function store(){
		try {
			Department::create(request()->validate([
				'name' => ['string', 'max:255', 'unique:departments,name']
			]));
			return redirect()->route('departments.index')->with([
				'success' => 'The department was created successfully.'
			]);
		} catch(Throwable $throwable){
			return back()->withInput()->with([
				'error' => $throwable->getMessage()
			]);
		}
	}

	public function edit(Department $department){
		return view('admin.departments.edit', compact('department'));
	}

	public function update(Department $department){
		try {
			$department->update(request()->validate([
				'name' => ['string', 'max:255', 'unique:departments,name']
			]));
			return redirect()->route('departments.index')->with([
				'success' => 'The department was updated successfully.'
			]);
		} catch(Throwable $throwable){
			return back()->withInput()->with([
				'error' => $throwable->getMessage()
			]);
		}
	}

	public function delete(Department $department){
		$department->delete();
		return redirect()->route('departments.index')->with([
			'success' => 'The department was deleted successfully.'
		]);
	}

}
