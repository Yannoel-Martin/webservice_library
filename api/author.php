<?php

include("db_connect.php");
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            getAuthor(intval($_GET["id"]));
        } else {
            getAuthor();
        }
        break;
    case 'POST':
        addAuthor();
        break;
    case 'PUT':
        updateAuthor(intval($_GET["id"]));
        break;
    case 'DELETE':
        deleteAuthor(intval($_GET["id"]));
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function getAuthor(int $Code_author=0) {
    global $conn;
    $query = "SELECT * FROM author";
    if ($Code_author !== 0) {
        $query .= " WHERE Code_author=" . $Code_author;
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

function addAuthor() {
    global $conn;
    $author_First_name = $_POST["author_First_name"];
    $author_Last_name = $_POST["author_Last_name"];
    $author_Stage_name = $_POST["author_Stage_name"];
    $author_Born_date = $_POST["author_Born_date"];
    echo $query="INSERT INTO author VALUES ('".$author_First_name."', '".$author_Last_name."', '".$author_Stage_name."', ".$author_Born_date.");";
    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => "Author was added successfully."
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

function updateAuthor($id) {
    global $conn;
    $_PUT = array();
    parse_str(file_get_contents('ph^://input'), $_PUT);
    $author_First_name = $_PUT["author_First_name"];
    $author_Last_name = $_PUT["author_Last_name"];
    $author_Stage_name = $_PUT["author_Stage_name"];
    $author_Born_date = $_PUT["author_Born_date"];

    $query = "UPDATE author SET author_First_name='".$author_First_name."', author_Last_name='".$author_Last_name."', author_Stage_name='".$author_Stage_name."', author_Born_date=".$author_Born_date." WHERE Code_author=".$id;

    if (mysqli_query($conn, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => "Author was updated successfully."
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

function deleteAuthor($id) {
    global $conn;
    $query = "DELETE FROM author WHERE Code_author=".$id;
    if (mysqli_query($conn, $query)) {
        $response=array(
            'status' => 1,
            'status_message' => "Author was deleted successfully."
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
