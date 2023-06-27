<?php

namespace App\Traits;

use App\Actions\UploadDocumentation;
use App\Contracts\Offer;
use App\Models\Application;
use Illuminate\Support\Facades\DB;

trait ManagesApplications {

	public function validateApplication():void{
		UploadDocumentation::validate();
		request()->validate([
			'major_id' => ['numeric', 'nullable', 'exists:majors,id'],
			'comments' => ['string', 'nullable', 'max:65535']
		]);
	}

	public function apply(Offer $offer):Application{
		return DB::transaction(function () use ($offer){
			$application = $offer->applications()->create([
				'user_id'  => request()->user()->id,
				'major_id' => request('major_id')
			]);
			UploadDocumentation::execute($application);
			if(request()->has('comments') && !empty(request('comments'))){
				$application->comments()->create([
					'user_id' => request()->user()->id,
					'text'    => request('comments')
				]);
			}
			return $application;
		});
	}

	public function updatePaymentUrl(Application $application, ?string $paymentUrl): void{
		$application->payment_url = $paymentUrl;
		$application->save();
	}

}