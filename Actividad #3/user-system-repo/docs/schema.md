# Documentación de Tablas y Relaciones

## Tablas Principales
- **users** → almacena nombre y email.
- **profiles** → relación 1:1 con users.
- **roles** → define tipo de usuario (admin, normal).

## Relaciones
- `users` ↔ `profiles` → 1:1
- `users` ↔ `roles` → n:1
- `users` ↔ `projects` → n:n
- Relaciones polimórficas simuladas con `comments` y `commentables`.


# Documentación de Tablas y Relaciones

## 📂 Base de Datos: `user_system_repo`

La base de datos está diseñada para manejar usuarios, perfiles, roles y proyectos,
incluyendo relaciones tradicionales y polimórficas.  

---

## 🧱 Estructura de Tablas y Tipos de Datos

### 🧩 Tabla `users`
| Campo | Tipo de Dato | Descripción | Seguridad / Hash |
|--------|---------------|--------------|------------------|
| `id` | `INT AUTO_INCREMENT PRIMARY KEY` | Identificador único del usuario | — |
| `name` | `VARCHAR(100)` | Nombre del usuario (solo letras) | Sanitizado con `htmlspecialchars()` y validado con RegEx |
| `email` | `VARCHAR(150)` | Correo electrónico único | Validado con `filter_var($email, FILTER_VALIDATE_EMAIL)` |
| `password` | `VARCHAR(255)` | Contraseña encriptada | **Hasheada** usando `password_hash($password, PASSWORD_DEFAULT)` (usa la librería interna de PHP `password_hash`) |

> 🔐 **Nota:** La función `password_hash()` usa por defecto el algoritmo **bcrypt**, el cual genera un hash seguro y único por cada contraseña.

---

### 🧩 Tabla `profiles`
| Campo | Tipo de Dato | Descripción |
|--------|---------------|-------------|
| `id` | `INT AUTO_INCREMENT PRIMARY KEY` | Identificador único del perfil |
| `user_id` | `INT UNIQUE` | Relación 1:1 con el usuario |
| `bio` | `TEXT` | Descripción breve del usuario |
| `created_at` | `DATETIME` | Fecha de creación del perfil |

---

### 🧩 Tabla `roles`
| Campo | Tipo de Dato | Descripción |
|--------|---------------|-------------|
| `id` | `INT AUTO_INCREMENT PRIMARY KEY` | Identificador del rol |
| `role_name` | `VARCHAR(50)` | Nombre del rol (Ejemplo: “Admin”, “User”) |

---

### 🧩 Tabla `user_roles` (Relación n:1)
| Campo | Tipo de Dato | Descripción |
|--------|---------------|-------------|
| `user_id` | `INT` | Usuario asignado |
| `role_id` | `INT` | Rol correspondiente |
| **Relaciones:** | | `FOREIGN KEY` a `users(id)` y `roles(id)` |

---

### 🧩 Tabla `projects` (Relación n:n)
| Campo | Tipo de Dato | Descripción |
|--------|---------------|-------------|
| `id` | `INT AUTO_INCREMENT PRIMARY KEY` | Identificador del proyecto |
| `project_name` | `VARCHAR(100)` | Nombre del proyecto |
| `created_at` | `DATETIME` | Fecha de registro |

---

### 🧩 Tabla `user_projects` (n:n)
| Campo | Tipo de Dato | Descripción |
|--------|---------------|-------------|
| `user_id` | `INT` | Relación con usuario |
| `project_id` | `INT` | Relación con proyecto |

---

### 🧩 Tabla `comments` (Relación polimórfica)
| Campo | Tipo de Dato | Descripción |
|--------|---------------|-------------|
| `id` | `INT AUTO_INCREMENT PRIMARY KEY` | Identificador del comentario |
| `body` | `TEXT` | Texto del comentario |
| `commentable_id` | `INT` | ID del elemento comentado |
| `commentable_type` | `VARCHAR(50)` | Tipo de entidad (por ejemplo: `User`, `Project`) |

> ⚙️ **Uso polimórfico:** permite asociar comentarios a múltiples entidades (por ejemplo, usuarios o proyectos) según el tipo.

---

## 🔐 Hashing y Sanitización

| Tipo de Dato | Técnica | Descripción |
|---------------|----------|-------------|
| **Texto** (`name`, `bio`) | `htmlspecialchars()` + `trim()` | Evita inyección de HTML o XSS. |
| **Email** | `filter_var($email, FILTER_VALIDATE_EMAIL)` | Valida formato correcto. |
| **Contraseña** | `password_hash($password, PASSWORD_DEFAULT)` | Encripta usando **bcrypt** (librería nativa de PHP). |
| **Entrada SQL** | `PDO::prepare()` + `bindParam()` | Previene **inyección SQL**. |

---

## 🔗 Resumen de Relaciones

| Tipo | Tablas Involucradas | Descripción |
|------|----------------------|--------------|
| 1 : 1 | `users` ↔ `profiles` | Cada usuario tiene un solo perfil. |
| n : 1 | `users` ↔ `roles` | Un rol puede tener muchos usuarios. |
| n : n | `users` ↔ `projects` | Un usuario puede estar en varios proyectos. |
| 1 : 1 (polimórfica) | `comments` ↔ `users` | Comentario sobre un solo usuario. |
| n : 1 (polimórfica) | `comments` ↔ `projects` | Varios comentarios en un mismo proyecto. |
| n : n (polimórfica) | `comments` ↔ `users/projects` | Permite asociar varios comentarios a múltiples entidades. |

---

## 📖 Herramientas Utilizadas
- **MySQL 8.0+** → Sistema de base de datos.  
- **PHP 8+** → Lógica del backend.  
- **PDO (PHP Data Objects)** → Conexión segura a la base de datos.  
- **password_hash()** → Librería nativa para hashing seguro.  
- **filter_var()** → Validación de datos.  
- **htmlspecialchars()** → Prevención de XSS.  

---

✅ Este diseño asegura:
- Integridad referencial mediante llaves foráneas.
- Seguridad contra inyección SQL y XSS.
- Hash seguro para credenciales.
