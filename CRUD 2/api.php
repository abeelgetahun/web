<?php
header('Content-Type: application/json');

// DB Connection
$conn = new mysqli("localhost", "root", "", "user_management");
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => $conn->connect_error]));
}

// Handle CRUD
$action = $_GET['action'] ?? '';
$data = json_decode(file_get_contents("php://input"));

switch($action) {
    case 'read':
        $result = $conn->query("SELECT * FROM users");
        $users = [];
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        echo json_encode($users);
        break;
        
    case 'create':
        $stmt = $conn->prepare("INSERT INTO users (name, email, phone, login_date) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $data->name, $data->email, $data->phone);
        $success = $stmt->execute();
        echo json_encode(['success' => $success]);
        break;
        
    case 'update':
        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, phone=? WHERE id=?");
        $stmt->bind_param("sssi", $data->name, $data->email, $data->phone, $data->id);
        $success = $stmt->execute();
        echo json_encode(['success' => $success]);
        break;
        
    case 'delete':
        $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param("i", $data->id);
        $success = $stmt->execute();
        echo json_encode(['success' => $success]);
        break;
}

$conn->close();
?>