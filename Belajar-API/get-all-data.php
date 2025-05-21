<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include 'connection.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'GET') {
    http_response_code(400);
    echo 'Only GET method is allowed.';
    exit();
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = mysqli_query($connect, "SELECT * FROM students WHERE student_id = $id");

    $response = [];
    $row = mysqli_fetch_object($sql);
    $response = $row;

} else {
    $sql = mysqli_query($connect, "SELECT * FROM students");

    $response = [];
    while ($result = mysqli_fetch_assoc($sql)) {
        $response[] = $result;
    }
}
header('Content-Type: application/json');
echo json_encode($response);

?>