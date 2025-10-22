1. Modelo de Negocio
Un modelo de negocio describe cómo una organización crea, entrega y captura valor. Incluye:
•	Propuesta de valor: Qué problema resuelve
•	Segmentos de clientes: A quién se dirige
•	Canales: Cómo llega al cliente
•	Flujos de ingresos: Cómo genera dinero
•	Recursos clave: Qué necesita para operar
2. GitHub - Crear Cuenta y Subir Repositorio
Crear cuenta en GitHub.com:
1.	Ir a github.com
2.	Click "Sign up"
3.	Ingresar email, contraseña, username
4.	Verificar email
Subir repositorio:
bash

# Inicializar repositorio local
git init
git add .
git commit -m "First commit"

# Conectar con repositorio remoto
git remote add origin https://github.com/usuario/repositorio.git
git push -u origin main

3. Git Clone - Métodos de Seguridad
Método	Descripción	Seguridad
HTTPS	git clone https://github.com/user/repo.git	Requiere usuario/contraseña o token
SSH	git clone git@github.com:user/repo.git	Más seguro, usa clave pública/privada
SSH es más recomendable para mayor seguridad.

4. Normalización de Bases de Datos
Forma Normal	Descripción
1FN	Eliminar grupos repetidos
2FN	Dependencia completa de la clave primaria
3FN	Eliminar dependencias transitivas

5. Validaciones en PHP para evitar Inyección SQL
Condicionales y ciclos:
php
<?php
// Validaciones con if, else if, switch
if (isset($_POST['username'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    
    // Validar longitud
    if (strlen($username) >= 3 && strlen($username) <= 16) {
        // Continuar procesamiento
    }
}

// Usando switch para tipos de operación
switch ($_POST['action']) {
    case 'create':
        // Validar datos para creación
        break;
    case 'update':
        // Validar datos para actualización
        break;
}

// Ciclos para validar múltiples entradas
foreach ($_POST as $key => $value) {
    $_POST[$key] = htmlspecialchars($value);
}
?>
CRUD Seguro con Prepared Statements:
php
<?php
// CREATE
$stmt = $pdo->prepare("INSERT INTO users (username, email) VALUES (?, ?)");
$stmt->execute([$username, $email]);

// READ
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);

// UPDATE
$stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
$stmt->execute([$username, $id]);

// DELETE
$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);
?>

6. Errores de Capa 8 (Error de Usuario)
Los "errores de capa 8" se refieren a errores humanos. Debemos programar para prevenirlos mediante:
•	Validación robusta de entrada
•	Mensajes de error claros
•	Interfaces intuitivas
•	Confirmaciones para acciones destructivas

7. Gestores de Paquetes
Composer (PHP):
bash
composer init
composer require package/name
npm (Node.js):
bash
npm init
npm install package-name
pnpm (Alternativa más rápida a npm):
bash
pnpm init
pnpm add package-name

8. Nomenclatura CamelCase en Inglés
php
<?php
// Variables en camelCase inglés
$userName = "john_doe";
$userEmail = "john@example.com";
$isActiveUser = true;
$createdAt = "2024-01-01";

// Funciones en camelCase
function getUserById($userId) {
    return "User data";
}

function validateUserInput($inputData) {
    // Validación aquí
}
?>

9. Expresión Regular: Ʌ (a-zA-Z 0-9_-)(3,16)
La expresión regular corregida sería:
regex
/^[a-zA-Z0-9_-]{3,16}$/
Explicación:
•	^ - Inicio de cadena
•	[a-zA-Z0-9_-] - Letras mayúsculas/minúsculas, números, guión y guión bajo
•	{3,16} - Longitud entre 3 y 16 caracteres
•	$ - Fin de cadena
Uso en PHP:
php
<?php
function validateUsername($username) {
    return preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $username);
}

// Ejemplo de uso
if (validateUsername($_POST['username'])) {
    // Username válido
} else {
    // Username inválido
}
?>

10. Ejemplo de Condicional Mayúscula/Minúscula
php
<?php
// Validar sin distinguir mayúsculas/minúsculas
$input = "ADMIN";
$role = "admin";

if (strtolower($input) === strtolower($role)) {
    echo "Coincide";
}

// O usando strcasecmp (case-insensitive comparison)
if (strcasecmp($input, $role) === 0) {
    echo "Coincide sin importar mayúsculas/minúsculas";
}
?>
