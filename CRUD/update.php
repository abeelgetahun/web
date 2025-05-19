<?php
header('Content-Type: application/json');
include 'config.php';

// Get posted data
$data = json_decode(file_get_contents("php://input"));

if(!isset($data->id) || !isset($data->name) || !isset($data->email) || !isset($data->phone)) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

try {
    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?");
    $result = $stmt->execute([$data->name, $data->email, $data->phone, $data->id]);
    
    if($result) {
        echo json_encode(['success' => true, 'message' => 'User updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'User update failed']);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>