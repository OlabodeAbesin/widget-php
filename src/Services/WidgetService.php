<?php


namespace Src\Services;


use JetBrains\PhpStorm\Pure;

class WidgetService {

    private string $offerRules;

    public function getCatalogue (): string {
        $catalogue = array(['name' => 'Red Widget', 'code' => 'R01', 'price' => '32.95'], ['name' => 'Green Widget', 'code' => 'G01', 'price' => '24.95'], ['name' => 'Blue Widget', 'code' => 'B01', 'price' => '7.95']);
        return json_encode($catalogue);
    }

    public function getRules (): string {
        $catalogue = ['Below $50 spend' => '$4.95', 'Below $90 spend' => '$4.95', '$90 or more' => 'Free'];
        return json_encode($catalogue);
    }

    public function getOffers (): bool|string {
        $offers = ['offer1' => 'Buy one red widget, get the second half price', 'code' => 'R01', 'price' => '32.95'];
        return json_encode($offers);
    }

    public function getAll (): bool|string {
        $offers = $this->getOffers();
        $rules = $this->getRules();
        $catalogue = $this->getCatalogue();
        return json_encode([$offers, $rules, $catalogue]);
    }

    //validate comma separated input
    //check Offer
    //Get Price
    //Add delivery cost

    public function getTotal (array $basket): string {
        $products = $this->validateInput($basket);
        if (!is_array($basket) || !$products) {
            return 'Incorrect input';
        }

        $selectedProducts = $this->checkOffers($products);
        $productPrice = $this->getPrices($selectedProducts);

        $totalCost = $this->addDeliveryCost($productPrice);
        return $this->presentOutput($totalCost, $selectedProducts);
    }


    //Private functions

    #[Pure] private function validateInput ($basket): array {
        foreach ($basket as $value) {
            $productDetailsArray[] = $this->getProductByCode($value);
        }
        return $productDetailsArray;
    }

    private function checkOffers ($productBasket): array {
        $redWidget = 0;
        foreach ($productBasket as $key => $value) {
            if ($value[ 'code' ] == "R01") {
                $redWidget++;
                if ($redWidget == 2) {
                    $this->offerRules = 'Buy one red widget, get the second half price';
                    $productBasket[ $key ][ 'price' ] = $value[ 'price' ] / 2;
                }
            }
        }
        return $productBasket;
    }


    private function getPrices (array $basket): float {
        $totalPrice = 0;
        foreach ($basket as $value) {
            $totalPrice += $value[ 'price' ];
        }
        return $totalPrice;
    }

    private function addDeliveryCost ($productPrice) {
        $totalPrice = $productPrice;
        if ($productPrice > 0 && $productPrice < 49.9) {
            $totalPrice += 4.95;
        }

        if ($productPrice > 49.9 && $productPrice < 90) {
            $totalPrice += 2.95;
        }
        return $totalPrice;
    }


    private function getProductByCode ($productCode): array {
        $products = array(array("title" => "Red Widget", "code" => "R01", "price" => 32.95, "offer" => "yes"), array("title" => "Green Widget", "code" => "G01", "price" => 24.95, "offer" => "no"), array("title" => "Blue Widget", "code" => "B01", "price" => 7.95, "offer" => "no"),);
        foreach ($products as $value) {
            if ($value[ 'code' ] == $productCode) {
                return $value;
            }
        }
    }

    private function presentOutput ($totalCost, $selectedProducts): string {
        $result = array();
        foreach ($selectedProducts as $value) {
            $products[] = $value[ 'code' ];
        }
        $result[ 'products' ] = implode(",", $products);
        $result[ 'total' ] = $totalCost;
        $result[ 'offerRule' ] = $this->offerRules ?? 'No offers for input';
        return json_encode($result);

    }
}