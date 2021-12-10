<?php


namespace Src;


use JetBrains\PhpStorm\Pure;
use Src\Services\WidgetService;

class WidgetController {

    public WidgetService $widgetService;

    #[Pure] public function __construct () {
        $this->widgetService = new WidgetService();
    }

    public function getCatalogue (): string {
        return $this->widgetService->getCatalogue();
    }

    public function getRules (): string {
        return $this->widgetService->getRules();
    }

    public function getOffers (): bool|string {
        return $this->widgetService->getOffers();
    }

    public function getAll (): bool|string {
        return $this->widgetService->getAll();
    }


    //validate comma separated input
    //check Offer
    //Get Price
    //Add delivery cost

    public function total (array $basket): string {
        return $this->widgetService->getTotal($basket);
    }
}