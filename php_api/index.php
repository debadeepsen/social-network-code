<?php

require_once("./main_controller.php");

// Allow CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type");

// Return JSON
header("Content-type: application/json; charset=utf-8");

if (!array_key_exists("path", $_GET)) {
    echo json_encode([
        "message" => "API Home"
    ]);
    die;
}

$path = $_GET["path"];

// remove last slash, if there is one
if ($path[strlen($path) - 1] == "/") {
    $path = substr($path, 0, strlen($path) - 1);
}

// find the corresponding function
$path = str_replace("/", "_", $path);
$parts = explode("_", $path);
$count = count($parts);

$id = $count == 3 ? $parts[2] : null;
$fn = $count == 3 ? $parts[0] . "_" . $parts[1] : $path;

if (function_exists($fn)) {
    $fn($id);
}


echo json_encode([
    "message" => "Invalid API Endpoint"
]);
