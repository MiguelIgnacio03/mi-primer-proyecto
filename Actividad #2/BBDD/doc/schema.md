
🧩 Base de datos: userdatabase

Esta base de datos está diseñada para almacenar información básica de usuarios, garantizando integridad, consistencia y compatibilidad con sistemas que implementen validación de datos y seguridad en el backend.

🧱 Tabla: users
Campo	Tipo de Dato	Restricciones / Características	Descripción
id	INT(11)	PRIMARY KEY, AUTO_INCREMENT, NOT NULL	Identificador único de cada usuario. Se incrementa automáticamente.
name	VARCHAR(100)	NOT NULL	Almacena el nombre del usuario. Debe contener únicamente letras (validado por backend o frontend).
email	VARCHAR(150)	NOT NULL, UNIQUE (recomendado)	Correo electrónico del usuario, validado mediante expresión regular y sanitizado antes de insertarse.
age	INT(11)	NOT NULL, CHECK (age > 0) (recomendado)	Edad del usuario, solo admite valores enteros positivos.
created_at	TIMESTAMP	DEFAULT CURRENT_TIMESTAMP	Fecha y hora de creación del registro. Se genera automáticamente.

🔐 Seguridad y Hashes

Aunque en este esquema no se incluye un campo de contraseña, en sistemas reales donde se almacenen credenciales, el campo correspondiente (por ejemplo, password_hash) debe utilizar un mecanismo de hash seguro:

Campo sugerido	Tipo de Dato	Descripción y Herramienta
password_hash	VARCHAR(255)	Se recomienda almacenar contraseñas cifradas con la función nativa de PHP password_hash() usando el algoritmo PASSWORD_BCRYPT. Para verificar la autenticidad se usa password_verify(). Estas funciones son parte del núcleo de PHP y no requieren librerías externas.

Ejemplo:

// Crear hash
$hash = password_hash($userPassword, PASSWORD_BCRYPT);

// Verificar contraseña
if (password_verify($userPassword, $hash)) {
    echo "Contraseña válida";
}

⚙️ Justificación de Tipos de Datos

INT(11) → Ideal para identificadores o valores numéricos (como la edad).

VARCHAR(100–150) → Permite almacenar texto de longitud controlada, útil para nombres y correos.

TIMESTAMP → Facilita el registro automático de la fecha y hora de creación.

HASH (VARCHAR 255) → Longitud estándar para contraseñas cifradas BCRYPT, si se implementa seguridad adicional.

🔗 Relaciones

Actualmente la base de datos userdatabase solo contiene una tabla (users).
Sin embargo, esta puede relacionarse fácilmente con otras tablas, por ejemplo:

profiles (relación 1 a 1)

posts (relación 1 a n)

roles (relación n a n)