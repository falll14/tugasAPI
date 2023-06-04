<?php
require_once "koneksi.php";
class movie
{
    public function get_movies()
    {
        global $koneksi;
        $query = "SELECT * FROM movies";
        $data = array();
        $result = $koneksi->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get List movie Successfully.',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function get_movie($id = 0)
    {
        global $koneksi;
        $query = "SELECT * FROM movies";
        if ($id != 0) {
            $query .= " WHERE id=" . $id . " LIMIT 1";
        }
        $data = array();
        $result = $koneksi->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get movie Successfully.',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function insert_movie()
    {
        global $koneksi;
        $arrcheckpost = array(
            'title' => '',
            'price' => '',
            'qty' => '',
            'director' => '',
            'studio' => ''
        );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($koneksi, "INSERT INTO movies SET
            title = '$_POST[title]',
            price = '$_POST[price]',
            qty = '$_POST[qty]',
            director = '$_POST[director]',
            studio = '$_POST[studio]'");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'movie Added Successfully.'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'movie Addition Failed.'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function update_movie($id)
    {
        global $koneksi;
        $arrcheckpost = array(
            'title' => '',
            'price' => '',
            'qty' => '',
            'director' => '',
            'studio' => ''
        );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($koneksi, "UPDATE movies SET
            title = '$_POST[title]',
            price = '$_POST[price]',
            qty = '$_POST[qty]',
            director = '$_POST[director]',
            studio = '$_POST[studio]'
            WHERE id='$id'");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'movie Updated Successfully.'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'movie Updation Failed.'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function delete_movie($id)
    {
        global $koneksi;
        $query = "DELETE FROM movies WHERE id=" . $id;
        if (mysqli_query($koneksi, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'movie Deleted Successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'movie Deletion Failed.'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}