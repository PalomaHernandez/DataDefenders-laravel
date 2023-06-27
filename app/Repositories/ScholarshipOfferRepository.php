<?php

namespace App\Repositories;

use App\Contracts\Offer;
use App\Contracts\OfferRepository;
use App\Contracts\UserRepository;
use App\Exceptions\OfferHasAtLeastOneRequestException;
use App\Models\ScholarshipOffer;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ScholarshipOfferRepository implements OfferRepository {

	private string $abilityAll = 'list.offers';

	private string $abilityPublic = 'apply.to.offers';

	private array $with = [
		'majors' => [
			'department'
		]
	];

	public function __construct(private readonly UserRepository $userRepository){}

	private function getBaseRequest():Builder{
		$user = $this->getUser();
		if($user?->can($this->abilityAll)){
			return ScholarshipOffer::with($this->with);
		} else if($user?->can($this->abilityPublic)){
			return ScholarshipOffer::with($this->with)->wherePublic(1);
		}
		abort(403);
	}

	public function findById(int $id):ScholarshipOffer|Model{
		return $this->getBaseRequest()->findOrFail($id);
	}

	private function getUser():?User{
		return $this->userRepository->authenticated();
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
		ScholarshipOffer::create($data);
	}

	public function update(int $id, array $data):void{
		$this->findById($id)->update($data);
	}

	public function deleteConfirm(int $id):Offer{
		$offer = $this->findById($id);
		if($offer->applications()->exists()){
			throw new OfferHasAtLeastOneRequestException();
		}
		return $offer;
	}

	public function delete(int $id):void{
		$offer = $this->findById($id);
		if($offer->applications()->exists()){
			throw new OfferHasAtLeastOneRequestException();
		}
		$offer->delete();
	}

}