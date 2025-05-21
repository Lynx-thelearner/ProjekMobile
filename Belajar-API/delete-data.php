<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include 'connection.php';

error_log("Request method: " . $_SERVER['REQUEST_METHOD']);
error_log("Query string: " . $_SERVER['QUERY_STRING']);


$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'DELETE') {
    http_response_code(400);
    echo json_encode(['status' => 'Failed', 'msg' => 'Only DELETE method is allowed.']);
    exit();
}

if (!isset($_GET['Student_id'])) {
    http_response_code(400);
    echo json_encode(['status' => 'Failed', 'msg' => 'Missing ID parameter.']);
    exit();
}

$id = $_GET['Student_id'];

$sql = mysqli_query($connect, "DELETE FROM students WHERE Student_id = '$id'");

if (!$sql) {
    http_response_code(500);
    echo json_encode(['status' => 'Failed', 'msg' => 'Query error: ' . mysqli_error($connect)]);
    exit();
}

$affectedRow = mysqli_affected_rows($connect);

header('Content-Type: application/json');
echo json_encode([
    'status' => 'OK',
    'msg' => 'Data has been deleted successfully',
    'affected_row' => $affectedRow
]);
?>
