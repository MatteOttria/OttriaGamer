<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../db/conn.php';
include_once '../object/gamer.php';

// instantiate database and gamer object
$database = new conn();
$db = $database->getConnection();

// initialize object
$gamer = new gamer($db);

// query gamer
$stmt = $gamer->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {
    // gamer array
    $gamer_arr = array();
    $gamer_arr["records"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        extract($row);
        $gamer_item = array(
            "id" => $row['id'],
            "nickname" => $row['nickname']
            "age" => $row['age']
            "level" => $row['level']
        );
        array_push($gamer_arr["records"], $gamer_item);
    }
    echo json_encode($gamer_arr);
} else {
    echo json_encode(
            array("message" => "No gamer found.")
    );
}