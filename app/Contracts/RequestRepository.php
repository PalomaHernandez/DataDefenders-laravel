<?php

namespace App\Contracts;

use App\Models\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface RequestRepository {

	public function findById(int $id):Request;

	public function getAllPending():Collection|array;

	public function getAllDocumentation():Collection|array;

	public function getAllAccepted():Collection|array;

	public function getAllRejected():Collection|array;

	public function getAllPendingPaginated():Collection|array|LengthAwarePaginator;

	public function getAllDocumentationPaginated():Collection|array|LengthAwarePaginator;

	public function getAllAcceptedPaginated():Collection|array|LengthAwarePaginator;

	public function getAllRejectedPaginated():Collection|array|LengthAwarePaginator;

}