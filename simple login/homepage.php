<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>This is your homepage.</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>