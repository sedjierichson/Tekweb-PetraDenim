<?php

session_start();

include $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");

$result = array(
  'status' => 0,
  'message' => 'Could not fetch data'
);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $result['status'] = 1;
    $result['message'] = $_SESSION['name'];

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}
