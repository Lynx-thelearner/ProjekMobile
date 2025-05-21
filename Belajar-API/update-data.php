<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include 'connection.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'PUT'){
    http_response_code(400);
    echo 'Only PUT method is allowed.';
    exit();
}

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

if (!isset($data['Student_id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Student_id is missing', 'raw' => $data]);
    exit();
}

$id     = $data['Student_id'];
$name   = $data['Student_name'];
$no     = $data['Student_no'];
$class  = $data['Stude_class'];

$sql = mysqli_query($connect, "UPDATE students
                                SET
                                student_no = '$no',
                                student_name = '$name',
                                Stude_class = '$class'  
                                WHERE
                                student_id = '$id'
                                ");
$affectedRow = mysqli_affected_rows($connect);                      

header('Content-Type: application/json');
echo json_encode([
                'status' => 'OK',
                'msg'    => 'Data has been edited successfully',
                'affected_row' => $affectedRow
            ]);
?>
