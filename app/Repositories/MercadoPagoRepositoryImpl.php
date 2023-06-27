<?php

namespace App\Repositories;

use App\Contracts\MercadoPagoRepository;
use App\Contracts\Offer;
use App\Models\Application;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;

class MercadoPagoRepositoryImpl implements MercadoPagoRepository {

	public function __construct(){
		SDK::setAccessToken(config('services.mercadopago.token'));
	}

	public function getPaymentUrl(Application $application):string{
		return $this->generatePaymentUrl($this->createPreference($application));
	}

	private function createPreference(Application $application):Preference{
		$preference = new Preference();
		$preference->items = $this->createItems($application->offer);
		$preference->back_urls = [
			'success' => route('application.payment', $application->id),
		];
		$preference->auto_return = "approved";
		$preference->save();
		return $preference;
	}

	private function createItems(Offer $offer):array{
		$item = new Item();
		$item->title = $offer->title;
		$item->quantity = 1;
		$item->unit_price = $offer->fee;
		return [$item];
	}

	private function generatePaymentUrl(Preference $preference):string{
		return config('app.env') == 'production' ? $preference->init_point : $preference->sandbox_init_point;
	}

}