<?php
require_once "dbConnection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userName = trim($_POST["userName"]);
    $userEmail = trim($_POST["userEmail"]);
    $userAge = trim($_POST["userAge"]);

    $errors = [];

    // ✅ Validación: el nombre solo puede contener letras y espacios
    if (!preg_match("/^[a-zA-Z\s]+$/", $userName)) {
        $errors[] = "The name must contain only letters and spaces (no numbers or symbols).";
    }

    // ✅ Validación: el correo electrónico debe tener formato válido
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // ✅ Validación: la edad debe ser numérica y razonable
    if (!is_numeric($userAge) || $userAge <= 0 || $userAge > 120) {
        $errors[] = "The age must be a valid number between 1 and 120.";
    }

    // ✅ Si no hay errores
    if (empty($errors)) {
        // Sanitización de los datos
        $safeName = htmlspecialchars($userName, ENT_QUOTES, 'UTF-8');
        $safeEmail = htmlspecialchars($userEmail, ENT_QUOTES, 'UTF-8');
        $safeAge = intval($userAge);

        // ✅ Insertar datos con consulta preparada (segura ante SQL Injection)
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, age) VALUES (:name, :email, :age)");
            $stmt->bindParam(":name", $safeName, PDO::PARAM_STR);
            $stmt->bindParam(":email", $safeEmail, PDO::PARAM_STR);
            $stmt->bindParam(":age", $safeAge, PDO::PARAM_INT);
            $stmt->execute();

            echo "<h3 style='color:green;'>✅ Data successfully validated and saved!</h3>";
            echo "<p><strong>Name:</strong> {$safeName}</p>";
            echo "<p><strong>Email:</strong> {$safeEmail}</p>";
            echo "<p><strong>Age:</strong> {$safeAge}</p>";
            echo "<hr><p>✔ Data has been sanitized and safely stored in the database.</p>";
        } catch (PDOException $e) {
            echo "<h3 style='color:red;'>❌ Database Error:</h3>";
            echo "<p>" . $e->getMessage() . "</p>";
        }
    } else {
        // Mostrar errores
        echo "<h3 style='color:red;'>❌ Validation errors:</h3><ul>";
        foreach ($errors as $error) {
            echo "<li>{$error}</li>";
        }
        echo "</ul>";
        echo "<a href='index.html'>Go back</a>";
    }
} else {
    header("Location: index.html");
    exit;
}
?>
