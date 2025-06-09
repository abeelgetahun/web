<?php

session_start();
// Session timeout settings
$timeout_duration = 100; // 15 minutes

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: login.html?timeout=1");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity time

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Get current time
date_default_timezone_set('Asia/Kolkata'); // Set your timezone if needed
$current_time = date('h:i:s A');

// Connect to database
require_once 'config.php';

// Fetch all users
$users = [];
$sql = "SELECT username FROM users";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row['username'];
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Current time: <?php echo $current_time; ?></p>
    <h3>All Registered Users:</h3>
    <ul>
        <?php foreach ($users as $user): ?>
            <li><?php echo htmlspecialchars($user); ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="logout.php">Logout</a>
</body>
</html>