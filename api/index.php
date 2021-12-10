<?php
require "../start.php";
use Src\Route;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );


// everything else results in a 404 Not Found
if ($uri[1] !== 'widget') {
  if($uri[1] !== 'widget'){
   echo "404!, please navigate to http://localhost:8000/widget";
    exit();
  }
}

//The second part of the url, it falls back to returning total if not passed
$command = null;
if (isset($uri[2])) {
    $command = $uri[2];
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the request method and process the HTTP request:
$controller = new Route($requestMethod, $command);
$controller->processRequest();