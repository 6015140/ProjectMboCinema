<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    gg
</body>
</html>
<?php

include 'database.php'; // Include your database connection file

session_start(); // Start the session

$user_id = $_SESSION['id'];
$query = "SELECT username, balance FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($username, $balance);
$stmt->fetch();
$stmt->close();
?>

<div class="profile">
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>Your account balance is: $<?php echo number_format($balance, 2); ?></p>
</div>