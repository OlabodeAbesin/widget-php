<?php

namespace Src;

class Route {

  private string $requestMethod;
  private string $command;
  private WidgetController $controller;

  public function __construct($requestMethod, $command)
  {
    $this->requestMethod = $requestMethod;
    $this->command = $command ?? '';
    $this->controller = new WidgetController();

  }

  public function processRequest()
  {
    switch ($this->requestMethod) {
      case 'GET':
        if ($this->command == 'get-catalogue') {
          $response = $this->controller->getCatalogue();

        } elseif ($this->command == 'get-rules'){
           $response = $this->controller->getRules();

        }
        elseif ($this->command == 'get-offers'){
           $response = $this->controller->getOffers();

        }
         elseif ($this->command == 'get-all'){
           $response = $this->controller->getAll();

        }
        else {
          $defaultData = ["B01","B01"];
         $response = $this->controller->total($defaultData);
        };
        break;


        case   'POST':
         $defaultData = ["B01","B01","R01","R01","R01"];
         $response = $this->controller->total($defaultData);
        break;
      default:
        //$response = $this->notFoundResponse();
        //break;
        $defaultData = ["B01","B01","R01","R01","R01"];
         $response = $this->controller->total($defaultData);
    }

    if ($response) {
      echo $response;
    }
  }
}