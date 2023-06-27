<?php

namespace App\Contracts;

use App\Models\Application;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ApplicationRepository {

	public function findById(int $id):Application;

	public function getAll():Collection|array;

	public function getAllPayment():Collection|array;

	public function getAllPending():Collection|array;

	public function getAllDocumentation():Collection|array;

	public function getAllAccepted():Collection|array;

	public function getAllRejected():Collection|array;

	public function getAllPaginated():Collection|array|LengthAwarePaginator;

	public function getAllPaymentPaginated():Collection|array|LengthAwarePaginator;

	public function getAllPendingPaginated():Collection|array|LengthAwarePaginator;

	public function getAllDocumentationPaginated():Collection|array|LengthAwarePaginator;

	public function getAllAcceptedPaginated():Collection|array|LengthAwarePaginator;

	public function getAllRejectedPaginated():Collection|array|LengthAwarePaginator;

	public function validateApplication():void;

	public function apply(Offer $offer):Application;

	public function updatePaymentUrl(Application $application, ?string $paymentUrl):void;

}