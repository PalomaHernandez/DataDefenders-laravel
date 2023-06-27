<?php

namespace App\Repositories;

use App\Contracts\Offer;
use App\Contracts\OfferRepository;
use App\Contracts\UserRepository;
use App\Exceptions\OfferHasAtLeastOneRequestException;
use App\Models\JobOffer;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class JobOfferRepository implements OfferRepository {

	private string $abilityAll = 'list.offers';

	private string $abilityPublic = 'apply.to.offers';

	private array $with = [
		'department' => [
			'majors'
		]
	];

	public function __construct(private readonly UserRepository $userRepository){}

	private function getBaseRequest():Builder{
		$user = $this->getUser();
		if($user?->can($this->abilityAll)){
			return JobOffer::with($this->with);
		} else if($user?->can($this->abilityPublic)){
			return JobOffer::with($this->with)->wherePublic(1);
		}
		abort(403);
	}

	private function getUser():?User{
		return $this->userRepository->authenticated();
	}

	public function findById(int $id):JobOffer|Model{
		return $this->getBaseRequest()->findOrFail($id);
	}

	public function all():Collection|array{
		return $this->getBaseRequest()->latest()->get();
	}

	public function paginated():Collection|LengthAwarePaginator|array{
		return $this->getBaseRequest()->latest()->paginate();
	}

	public function paginatedWithApplicationCount():Collection|LengthAwarePaginator|array{
		return $this->getBaseRequest()->withCount('applications')->latest()->paginate();
	}

	public function store(array $data):void{
		JobOffer::create($data);
	}

	public function update(int $id, array $data):void{
		$this->findById($id)->update($data);
	}

	/**
	 * @throws OfferHasAtLeastOneRequestException
	 */
	public function deleteConfirm(int $id):Offer{
		$offer = $this->findById($id);
		if($offer->applications()->exists()){
			throw new OfferHasAtLeastOneRequestException();
		}
		return $offer;
	}

	/**
	 * @throws OfferHasAtLeastOneRequestException
	 */
	public function delete(int $id):void{
		$offer = $this->findById($id);
		if($offer->applications()->exists()){
			throw new OfferHasAtLeastOneRequestException();
		}
		$offer->delete();
	}

}