<?php

namespace App\Repositories;

use App\Contracts\ApplicationRepository;
use App\Contracts\MercadoPagoRepository;
use App\Contracts\UserRepository;
use App\Models\Application;
use App\Models\User;
use App\Patterns\State\Request\ApplicationStatus;
use App\Traits\ManagesApplications;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ApplicationRepositoryImpl implements ApplicationRepository {

	use ManagesApplications;

	private array $with = [
		'documentationFiles',
		'offer',
		'comments' => [
			'user'
		]
	];

	private string $abilityAll = 'list.applications';

	private string $abilityOwn = 'list.own.applications';

	public function __construct(
		private readonly MercadoPagoRepository $mercadoPagoRepository,
		private readonly UserRepository $userRepository,
	){}

	public function findById(int $id):Application{
		return $this->getBaseRequest()->whereId($id)->firstOrFail();
	}

	private function getBaseRequest():Builder{
		$user = $this->getUser();
		if($user?->can($this->abilityAll)){
			return Application::with($this->with);
		} else if($user?->can($this->abilityOwn)){
			return Application::with($this->with)->whereUserId($user?->id);
		}
		abort(403);
	}

	private function getUser():?User{
		return $this->userRepository->authenticated();
	}

	public function getAll():array|Collection{
		return $this->getBaseRequest()->latest()->get();
	}

	public function getAllPayment():array|Collection{
		return $this->getBaseRequest()->whereStatus(ApplicationStatus::Payment)->latest()->get();
	}

	public function getAllPending():array|Collection{
		return $this->getBaseRequest()->whereStatus(ApplicationStatus::Pending)->latest()->get();
	}

	public function getAllDocumentation():array|Collection{
		return $this->getBaseRequest()->whereStatus(ApplicationStatus::Documentation)->latest()->get();
	}

	public function getAllAccepted():array|Collection{
		return $this->getBaseRequest()->whereStatus(ApplicationStatus::Accepted)->latest()->get();
	}

	public function getAllRejected():array|Collection{
		return $this->getBaseRequest()->whereStatus(ApplicationStatus::Rejected)->latest()->get();
	}

	public function getAllPaginated():array|LengthAwarePaginator|Collection{
		return $this->getBaseRequest()->latest()->paginate();
	}

	public function getAllPaymentPaginated():array|LengthAwarePaginator|Collection{
		return $this->getBaseRequest()->whereStatus(ApplicationStatus::Payment)->latest()->paginate();
	}

	public function getAllPendingPaginated():array|LengthAwarePaginator|Collection{
		return $this->getBaseRequest()->whereStatus(ApplicationStatus::Pending)->latest()->paginate();
	}

	public function getAllDocumentationPaginated():array|LengthAwarePaginator|Collection{
		return $this->getBaseRequest()->whereStatus(ApplicationStatus::Documentation)->latest()->paginate();
	}

	public function getAllAcceptedPaginated():array|LengthAwarePaginator|Collection{
		return $this->getBaseRequest()->whereStatus(ApplicationStatus::Accepted)->latest()->paginate();
	}

	public function getAllRejectedPaginated():array|LengthAwarePaginator|Collection{
		return $this->getBaseRequest()->whereStatus(ApplicationStatus::Rejected)->latest()->paginate();
	}

}