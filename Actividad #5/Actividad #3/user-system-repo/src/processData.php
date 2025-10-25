<?php
include 'dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        echo "<p style='color:red;'>Name must contain only letters.</p>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Invalid email format.</p>";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    echo "<p style='color:green;'>User saved successfully!</p>";
}
?>