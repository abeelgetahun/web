<?php
header('Content-Type: application/json');
include 'config.php';

// Get posted data
$data = json_decode(file_get_contents("php://input"));

if(!isset($data->name) || !isset($data->email) || !isset($data->phone)) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

try {
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, login_date) VALUES (?, ?, ?, NOW())");
    $result = $stmt->execute([$data->name, $data->email, $data->phone]);
    
    if($result) {
        echo json_encode(['success' => true, 'message' => 'User created']);
    } else {
        echo json_encode(['success' => false, 'message' => 'User creation failed']);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>