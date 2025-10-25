<?php
include 'dbConnection.php';

$stmt = $conn->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Registered Users</h2><ul>";
foreach ($users as $user) {
    echo "<li>{$user['name']} - {$user['email']}</li>";
}
echo "</ul>";
?>