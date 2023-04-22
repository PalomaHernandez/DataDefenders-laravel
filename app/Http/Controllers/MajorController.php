<?php

namespace App\Http\Controllers;

use App\Exceptions\MajorHasAtLeastOneOfferException;
use App\Models\Department;
use App\Models\Major;
use Illuminate\Http\Request;
use Throwable;

class MajorController extends Controller
{
    public function index(){
        $departments = Department::all();
		return view('admin.majors.index', compact('departments'));
	}

	public function create(Department $department){
		return view('admin.majors.create', compact('department'));
	}

	public function store(Department $department){
		try {
			Major::create(request()->validate([
				'name' => ['string', 'max:255', 'unique:majors,name']
			]));
			return redirect()->route('majors.index')->with([
				'success' => 'The major was created successfully.'
			]);
		} catch(Throwable $throwable){
			return back()->withInput()->with([
				'error' => $throwable->getMessage()
			]);
		}
	}

	public function edit(Major $major){
		return view('admin.majors.edit', compact('major'));
	}

	public function update(Major $major){
		try {
			$major->update(request()->validate([
				'name' => ['string', 'max:255', 'unique:majors,name']
			]));
			return redirect()->route('majors.index')->with([
				'success' => 'The major was updated successfully.'
			]);
		} catch(Throwable $throwable){
			return back()->withInput()->with([
				'error' => $throwable->getMessage()
			]);
		}
	}

	public function delete_confirm(Major $major){
        try {
            if($major->scholarshipOffers()->exists()){
                throw new MajorHasAtLeastOneOfferException();
            }
            return view('admin.majors.delete', compact('major'));
        } catch(MajorHasAtLeastOneOfferException $exception){
            abort(403, $exception->getMessage());
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
            return back()->with([
                'error' => $exception->getMessage()
            ]);
        }
    }
}
