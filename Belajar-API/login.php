<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");
error_reporting(0); // jangan munculin warning/error PHP

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'Failed', 'msg' => 'Only POST allowed']);
    exit;
}

$postData = file_get_contents("php://input");
$data = json_decode($postData, true);

$username = $data['username'] ?? '';
$password = sha1($data['password'] ?? '');

$query = mysqli_query($connect, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$numRows = mysqli_num_rows($query);

if ($numRows > 0) {
    $user = mysqli_fetch_assoc($query);
    echo json_encode([
        'status' => 'OK',
        'msg' => 'Login Success',
        'data' => $user
    ]);
} else {
    echo json_encode([
        'status' => 'Failed',
        'msg' => 'Login Failed',
        'data' => null
    ]);
}
