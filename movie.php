<?php
require_once "method.php";
$obj_movie = new movie();
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $obj_movie->get_movie($id);
        } else {
            $obj_movie->get_movies();
        }
        break;
    case 'POST':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $obj_movie->update_movie($id);
        } else {
            $obj_movie->insert_movie();
        }
        break;
    case 'DELETE':
        $id = intval($_GET["id"]);
        $obj_movie->delete_movie($id);
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}