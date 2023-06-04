<?php

namespace App\Http\Controllers;

use App\Actions\ChangeRequestStatus;
use App\Actions\UploadDocumentation;
use App\Contracts\ApplicationRepository;
use App\Exceptions\RequestCannotBeUpdatedException;
use App\Exceptions\TransitionNotAllowedException;
use App\Models\DocumentationFile;
use App\Models\JobOffer;
use App\Models\Application;
use App\Models\ScholarshipOffer;
use App\Patterns\State\Request\ApplicationStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use Illuminate\Validation\ValidationException;

class ApplicationController extends Controller {

	public function __construct(private readonly ApplicationRepository $repository){}

	public function index(){
		$applications = $this->repository->getAllPendingPaginated();
		return view('admin.applications.index', compact('applications'));
	}

	public function edit(Application $application){
		return view('admin.applications.edit', compact('application'));
	}

	public function document_confirm(Application $application){
		try {
			if($application->cannot_update){
				throw new RequestCannotBeUpdatedException();
			}
			return view('admin.applications.document', compact('application'));
		} catch(RequestCannotBeUpdatedException $exception){
			throw ValidationException::withMessages([
				'general' => $exception->getMessage()
			]);
		}
	}

	public function document(int $applicationId){
		try {
			$application = $this->repository->findById($applicationId);
			if($application->cannot_update){
				throw new RequestCannotBeUpdatedException();
			}
			$this->requireCommentAndTransition($application, ApplicationStatus::Documentation);
			return $this->returnToIndex($application);
		} catch(InvalidArgumentException|TransitionNotAllowedException $exception){
			throw ValidationException::withMessages([
				'comments' => $exception->getMessage()
			]);
		} catch(RequestCannotBeUpdatedException $exception){
			throw ValidationException::withMessages([
				'general' => $exception->getMessage()
			]);
		}
	}

	public function accept_confirm(Application $application){
		try {
			if($application->cannot_update){
				throw new RequestCannotBeUpdatedException();
			}
			return view('admin.applications.accept', compact('application'));
		} catch(RequestCannotBeUpdatedException $exception){
			throw ValidationException::withMessages([
				'general' => $exception->getMessage()
			]);
		}
	}

	public function accept(int $applicationId){
		try {
			$application = $this->repository->findById($applicationId);
			if($application->cannot_update){
				throw new RequestCannotBeUpdatedException();
			}
			$this->commentAndTransition($application, ApplicationStatus::Accepted);
			return $this->returnToIndex($application);
		} catch(InvalidArgumentException|TransitionNotAllowedException $exception){
			throw ValidationException::withMessages([
				'comments' => $exception->getMessage()
			]);
		} catch(RequestCannotBeUpdatedException $exception){
			throw ValidationException::withMessages([
				'general' => $exception->getMessage()
			]);
		}
	}

	public function reject_confirm(Application $application){
		try {
			if($application->cannot_update){
				throw new RequestCannotBeUpdatedException();
			}
			return view('admin.applications.reject', compact('application'));
		} catch(RequestCannotBeUpdatedException $exception){
			throw ValidationException::withMessages([
				'general' => $exception->getMessage()
			]);
		}
	}

	public function reject(int $applicationId){
		try {
			$application = $this->repository->findById($applicationId);
			if($application->cannot_update){
				throw new RequestCannotBeUpdatedException();
			}
			$this->requireCommentAndTransition($application, ApplicationStatus::Rejected);
			return $this->returnToIndex($application);
		} catch(InvalidArgumentException|TransitionNotAllowedException $exception){
			throw ValidationException::withMessages([
				'comments' => $exception->getMessage()
			]);
		} catch(RequestCannotBeUpdatedException $exception){
			throw ValidationException::withMessages([
				'general' => $exception->getMessage()
			]);
		}
	}

	public function review(int $applicationId){
		try {
			$application = $this->repository->findById($applicationId);
			if($application->cannot_update){
				throw new RequestCannotBeUpdatedException();
			}
			$files = $this->uploadDocumentation($application);
			$this->commentAndTransition($application, ApplicationStatus::Pending);
			return response()->json([
				'res' => true,
				'text' => 'Your documentation has been submitted for review successfully.',
				'files' => $files,
			]);
		} catch(InvalidArgumentException|TransitionNotAllowedException|RequestCannotBeUpdatedException $exception){
			throw ValidationException::withMessages([
				'general' => $exception->getMessage()
			]);
		}
	}

	public function getFile(int $documentationFileId){
		$documentationFile = DocumentationFile::findOrFail($documentationFileId);
		return response(Storage::get($documentationFile->path), headers: [
			'Content-Type' => 'application/pdf'
		]);
	}

	/**
	 * @throws InvalidArgumentException|TransitionNotAllowedException
	 */
	private function commentAndTransition(Application $application, ApplicationStatus $status){
		if(request()->has('comments') && !empty(request('comments'))){
			$validated = request()->validate([
				'comments' => ['string', 'required']
			]);
			$application->comments()->create([
				'user_id' => auth()->id(),
				'text' => $validated['comments']
			]);
		}
		ChangeRequestStatus::execute($application, $status);
	}

	/**
	 * @throws InvalidArgumentException|TransitionNotAllowedException
	 */
	private function requireCommentAndTransition(Application $application, ApplicationStatus $status){
		$validated = request()->validate([
			'comments' => ['string', 'required']
		]);
		$application->comments()->create([
			'user_id' => auth()->id(),
			'text' => $validated['comments']
		]);
		ChangeRequestStatus::execute($application, $status);
	}

	private function uploadDocumentation(Application $application):Collection{
		UploadDocumentation::validate();
		return UploadDocumentation::execute($application);
	}

	private function returnToIndex(Application $application){
		if($application->offer_type == JobOffer::class){
			return redirect()->route('applications.job.index');
		}
		if($application->offer_type == ScholarshipOffer::class){
			return redirect()->route('applications.scholarship.index');
		}
		return redirect()->route('applications.index');
	}

	public function find(int $applicationId){
		return response()->json($this->repository->findById($applicationId));
	}

	public function findFile(int $documentationFileId){
		return response()->json(DocumentationFile::findOrFail($documentationFileId));
	}

	public function all(){
		return response()->json($this->repository->getAll());
	}

	public function pending(){
		return response()->json($this->repository->getAllPending());
	}

	public function documentation(){
		return response()->json($this->repository->getAllDocumentation());
	}

	public function accepted(){
		return response()->json($this->repository->getAllAccepted());
	}

	public function rejected(){
		return response()->json($this->repository->getAllRejected());
	}

	public function allPaginated(){
		return response()->json($this->repository->getAllPaginated());
	}

	public function pendingPaginated(){
		return response()->json($this->repository->getAllPendingPaginated());
	}

	public function documentationPaginated(){
		return response()->json($this->repository->getAllDocumentationPaginated());
	}

	public function acceptedPaginated(){
		return response()->json($this->repository->getAllAcceptedPaginated());
	}

	public function rejectedPaginated(){
		return response()->json($this->repository->getAllRejectedPaginated());
	}

}
