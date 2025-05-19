<?php
// --- DB CONNECTION ---
$pdo = new PDO("mysql:host=localhost;dbname=root;charset=utf8", "user_auth", "");

// --- HANDLE ACTIONS ---
$action = $_GET['action'] ?? '';

if ($action == 'read') {
    $stmt = $pdo->query("SELECT * FROM items");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}
elseif ($action == 'create') {
    $name = $_POST['name'];
    $pdo->prepare("INSERT INTO items (name) VALUES (?)")->execute([$name]);
}
elseif ($action == 'update') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $pdo->prepare("UPDATE items SET name=? WHERE id=?")->execute([$name, $id]);
}
elseif ($action == 'delete') {
    $id = $_POST['id'];
    $pdo->prepare("DELETE FROM items WHERE id=?")->execute([$id]);
}
?>