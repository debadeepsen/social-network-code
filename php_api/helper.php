<?php

function mysqli_object()
{
    // $mysqli = new mysqli("localhost:3306", "root", "", "kuiqdb");
    $mysqli = new mysqli("208.82.114.162", "debadeep_user", "DebadeepDatabaseUser", "debadeep_kuiq");

    // this is done to be able to store 
    // unicode utf8 properly
    $mysqli->query("SET NAMES utf8;");
    return $mysqli;
}

function req_body()
{
    $body = json_decode(file_get_contents("php://input"), true);
    return $body;
}

function query_result($query)
{
    $mysqli = mysqli_object();
    if ($mysqli->connect_errno) {
        echo json_encode(["error" => "Failed to connect to MySQL: " . $mysqli->connect_error]);
        exit();
    }

    $sql = $query;
    $result = $mysqli->query($sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);

    $result->free_result();
    $mysqli->close();

    return $data;
}


function json($data, $success = true, $message = false)
{
    echo json_encode(
        [
            "success" => true,
            "message" => "",
            "data" => $data
        ]
    );
}
