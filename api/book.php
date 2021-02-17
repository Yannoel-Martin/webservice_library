<?php

include("db_connect.php");
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            getBook(intval($_GET["id"]));
        } else {
            getBook();
        }
        break;
    case 'POST':
        addBook();
        break;
    case 'PUT':
        updateBook(intval($_GET["id"]));
        break;
    case 'DELETE':
        deleteBook(intval($_GET["id"]));
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function getBook(int $Code_book=0) {
    global $conn;
    $query = "SELECT * FROM book";
    if ($Code_book !== 0) {
        $query .= " WHERE Code_book=" . $Code_book;
    }
    $response = array();
    $result = mysqli_query($conn, $query);
    if ($result !== false) {
        while ($row = mysqli_fetch_array($result)) {
            $response[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($response, JSON_PRETTY_PRINT);
    } else {
        echo '<p style="color: red;">Erreur : '.mysqli_error($conn).'</p>';
    }
}

function addBook() {
    global $conn;
    $book_Name = $_POST["book_Name"];
    $book_Editor = $_POST["book_Editor"];
    $book_Publication_date = $_POST["book_Publication_date"];
    $book_Price = $_POST["book_Price"];
    echo $query="INSERT INTO book VALUES ('".$book_Name."', '".$book_Editor."', '".$book_Publication_date."', ".$book_Price.");";
    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => "Book was added successfully."
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => "Error ! ".mysqli_error($conn)
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function updateBook($id) {
    global $conn;
    $_PUT = array();
    parse_str(file_get_contents('ph^://input'), $_PUT);
    $book_Name = $_PUT["book_Name"];
    $book_Editor = $_PUT["book_Editor"];
    $book_Publication_date = $_PUT["book_Publication_date"];
    $book_Price = $_PUT["book_Price"];

    $query = "UPDATE book SET book_Name='".$book_Name."', book_Editor='".$book_Editor."', book_Publication_date='".$book_Publication_date."', book_Price=".$book_Price." WHERE Code_book=".$id;

    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => "Book was updated successfully."
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => "Error ! ".mysqli_error($conn)
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function deleteBook($id) {
    global $conn;
    $query = "DELETE FROM book WHERE Code_book=".$id;
    if (mysqli_query($conn, $query)) {
        $response=array(
            'status' => 1,
            'status_message' => "Book was deleted successfully."
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => "Error ! ".mysqli_error($conn)
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
