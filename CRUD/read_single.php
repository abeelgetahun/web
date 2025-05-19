<?php
header('Content-Type: application/json');
include 'config.php';

$id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['success' => false, 'message' => 'ID is required']));

try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($user) {
        echo json_encode($user);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>