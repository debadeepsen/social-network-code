<?php

require_once("./helper.php");

function login()
{
    $body = req_body();
    $email = $body["email"];
    $password = $body["password"];

    $query = "SELECT * FROM `user` u WHERE u.Email = '$email' 
             AND u.Password = MD5(CONCAT_WS('$password', '|', u.Salt))";

    $data = query_result($query);

    if (count($data) == 1)
        json($data[0]);
    else
        json(null, false, "Invalid credentials");
    die;
}

function user_list()
{
    echo json_encode(["m" => "logged in and users"]);
    die;
}

function note_list($userId)
{
    $query = "SELECT *
                FROM `note` n WHERE n.CreatedBy = '$userId' ORDER BY n.CreatedDateTime DESC";

    $data = query_result($query);

    json($data);
    die;
}

function note_shortlist($userId)
{
    $query = "SELECT n.NoteId, n.NoteCaption, n.CreatedDateTime
                FROM `note` n WHERE n.CreatedBy = '$userId' ORDER BY n.CreatedDateTime DESC";

    $data = query_result($query);

    json($data);
    die;
}

function note_detail($noteId)
{
    $query = "SELECT n.*
                FROM `note` n WHERE n.NoteId = '$noteId'";

    $data = query_result($query);

    json($data[0]);
    die;
}
