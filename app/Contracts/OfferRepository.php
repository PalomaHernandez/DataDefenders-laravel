<?php

namespace App\Contracts;

use App\Exceptions\OfferHasAtLeastOneRequestException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface OfferRepository {

	public function findById(int $id):Offer|Model;

	public function all():Collection|array;

	public function paginated():Collection|LengthAwarePaginator|array;

	public function paginatedWithApplicationCount():Collection|LengthAwarePaginator|array;

	public function store(array $data):void;

	public function update(int $id, array $data):void;

	/**
	 * @throws OfferHasAtLeastOneRequestException
	 */
	public function deleteConfirm(int $id):Offer;

	/**
	 * @throws OfferHasAtLeastOneRequestException
	 */
	public function delete(int $id):void;

}