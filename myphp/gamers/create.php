<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../db/conn.php';
include_once '../object/gamer.php';

$database = new conn();
$db = $database->getConnection();

// initialize object
$gamer = new gamer($db);

// get posted data
$data = json_decode(file_get_contents("php://input", true));

// set gamer property value
$gamer->name = $data->name;

// create the gamer
if ($gamer->create()) {
    echo '{';
    echo '"message": "gamer was created."';
    echo '}';
}

// if unable to create the gamer, tell the user
else {
    echo '{';
    echo '"message": "Unable to create gamer."';
    echo '}';
}