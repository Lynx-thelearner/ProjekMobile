<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include 'connection.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST'){
    http_response_code(400);
    echo 'Only POST method is allowed.';
    exit();
}

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

$no = $data['Student_no'];
$name = $data['Student_name'];
$class = $data['Stude_class'];

$sql = mysqli_query($connect, "INSERT INTO students 
    (Student_id, Student_no, Student_name, Stude_class) VALUES(null, '$no', '$name', '$class')");
$insertedId = mysqli_insert_id($connect);


header('Content-Type: application/json');
echo json_encode([
    'status'=> 'OK',
    'msg'=> 'Data Created Success',
    'id'=> $insertedId
    ]);













?>