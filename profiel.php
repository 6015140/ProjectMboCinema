<?php
// Database verbinding
try {
    $conn = new PDO('mysql:host=localhost;dbname=phplesjaar2', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Verbinding mislukt: " . $e->getMessage();
    exit;
}

// Start de sessie
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Verwijs naar loginpagina als niet ingelogd
    exit;
}

// Haal de gebruikersgegevens op
$user_id = $_SESSION['id'];

$query = "SELECT username, email, balance FROM users WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Gebruiker niet gevonden.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profielpagina</title>
</head>
<body>
    <h1>Welkom, <?php echo htmlspecialchars($user['username']); ?>!</h1>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Saldo: €<?php echo number_format($user['balance'], 2); ?></p>
    <a href="logout.php">Uitloggen</a>
</body>
</html>
