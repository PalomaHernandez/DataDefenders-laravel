<?php

namespace App\Repositories;

use App\Contracts\ApplicationRepository;
use App\Contracts\MercadoPagoRepository;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;

class MercadoPagoRepositoryImpl implements MercadoPagoRepository {

    public function __construct(
		private readonly ApplicationRepository $applicationRepository,
	){}

    public function createPayment(int $applicationId): string{
        SDK::setAccessToken(config('services.mercadopago.token'));
      
        $application = $this->applicationRepository->findById($applicationId);
        $preference = new Preference();
        $item = new Item();

        $offer = $application->offer;
        $item->title = $offer->title;
        $item->quantity = 1;
        $item->unit_price = $offer->fee;

        $preference->items = [$item];
        $preference->back_urls = [
            'success' => route('application.payment', $applicationId),
        ];
        $preference->auto_return = "approved";
        $preference->save();

        if(config('app.env') == 'production'){
            $paymentUrl = $preference->init_point;
        } else {
            $paymentUrl = $preference->sandbox_init_point;
        }
      
        $this->applicationRepository->updatePaymentUrl($application, $paymentUrl);
        return $paymentUrl;
    }

}