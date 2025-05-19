<?php
header('Content-Type: application/json');
include 'config.php';

$id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['success' => false, 'message' => 'ID is required']));

try {
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $result = $stmt->execute([$id]);
    
    if($result) {
        echo json_encode(['success' => true, 'message' => 'User deleted']);
    } else {
        echo json_encode(['success' => false, 'message' => 'User deletion failed']);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>