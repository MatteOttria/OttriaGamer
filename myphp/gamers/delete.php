<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../db/conn.php';
include_once '../object/gamer.php';

$database = new conn();
$db = $database->getConnection();

// initialize object
$gamer = new gamer($db);

// set ID property of gamer to be deleted
$gamer->id = filter_input(INPUT_GET, 'id');

// delete the gamer
if ($gamer->delete()) {
    echo '{';
    echo '"message": "gamer was deleted."';
    echo '}';
}

// if unable to delete the gamer
else {
    echo '{';
    echo '"message": "Unable to delete gamer."';
    echo '}';
}