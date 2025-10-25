🧩 1. Constantes en PHP
🔹 ¿Qué es una constante?

Una constante es un identificador (nombre) que almacena un valor que no puede cambiar durante la ejecución del programa.

🔹 ¿Cómo se define?
define("NOMBRE_CONSTANTE", "Valor");


O con const:

const PI = 3.1416;

🔹 ¿Cuándo se usan?

Cuando necesitas valores fijos (por ejemplo, rutas, claves, URL del servidor, límites).

En configuraciones o parámetros globales.

🔹 Constantes predefinidas

PHP incluye muchas, entre ellas:

PHP_VERSION → versión actual de PHP

PHP_OS → sistema operativo

__LINE__ → línea actual del archivo

__FILE__ → ruta completa del archivo

__DIR__ → directorio actual

__FUNCTION__, __CLASS__, __METHOD__, __TRAIT__ → información de contexto

🌐 2. Variables de entorno
🔹 ¿Qué son?

Son valores configurados en el sistema o servidor que afectan cómo se ejecuta una aplicación (por ejemplo, contraseñas, rutas, claves API).

🔹 ¿Cómo se aplican?

En PHP, se acceden con getenv() o $_ENV.

$usuario = getenv('DB_USER');

🔹 Uso en desarrollo y producción:

Desarrollo: variables de entorno con valores de prueba.

Producción: valores reales (sin exponer credenciales en el código).

➗ 3. Operadores aritméticos y lógicos
🔹 Aritméticos:
Operador	Descripción
+	Suma
-	Resta
*	Multiplicación
/	División
%	Módulo (residuo)
🔹 Lógicos:
Operador	Descripción
&& o and	Y lógico
`	
!	Negación lógica

🌍 4. Variables superglobales

Son variables internas de PHP accesibles desde cualquier parte del código:

Variable	Descripción
$_SERVER	Información del servidor (IP, nombre, script actual).
$_GET	Datos enviados por la URL.
$_POST	Datos enviados mediante formulario (método POST).
$_FILES	Información sobre archivos subidos.
$_COOKIE	Datos almacenados en cookies.
$_SESSION	Variables persistentes de sesión del usuario.
$_REQUEST	Combina $_GET, $_POST y $_COOKIE.

⚙️ 5. Funciones, clases y POO
🔹 Función

Bloque de código reutilizable que realiza una tarea específica.

function saludar($nombre) {
  return "Hola, $nombre";
}

🔹 Clase

Plantilla para crear objetos con propiedades (atributos) y métodos (funciones).

class Persona {
  public $nombre;

  function saludar() {
    return "Hola, soy $this->nombre";
  }
}

🔹 Objeto

Instancia de una clase:

$persona = new Persona();
$persona->nombre = "Miguel";
echo $persona->saludar();

🔹 Herencia

Una clase hija hereda propiedades y métodos de otra clase.

class Empleado extends Persona {
  public $cargo;
}

🔹 Polimorfismo

Capacidad de redefinir métodos en clases hijas.

🔹 POO (Programación Orientada a Objetos)

Paradigma que organiza el código en objetos.
Características:

Abstracción

Encapsulación

Herencia

Polimorfismo

🧱 6. Estructura MVC en PHP

Modelo-Vista-Controlador (MVC) separa la lógica en tres capas:

Modelo: gestiona datos y base de datos.

Vista: interfaz del usuario (HTML).

Controlador: conecta modelo y vista.

Ejemplo de estructura:

/app
  /models
  /views
  /controllers
index.php

🧰 7. Funciones predefinidas útiles
Tipo	Funciones	Descripción
Debugging	var_dump(), print_r()	Muestran información de variables.
Fecha y hora	date(), time()	Devuelven la fecha/hora actual.
Matemáticas	sqrt(), rand(), pi(), round()	Raíz cuadrada, número aleatorio, PI, redondeo.
Tipo de variable	gettype(), is_string(), is_float(), isset()	Comprueban tipo o existencia.
Texto	trim(), strlen(), strpos(), str_replace(), strtolower(), strtoupper()	Manipulación de cadenas.
🔹 Sanitización de datos

Antes de enviar un formulario:

$nombre = trim($_POST['nombre']);
$nombre = htmlspecialchars($nombre);
$nombre = stripslashes($nombre);


→ Previene inyecciones y ataques XSS.

🛡️ 8. Seguridad web
Ataque	Prevención	Efectos
XSS (Cross-Site Scripting)	htmlspecialchars() en entradas.	Inyección de scripts maliciosos.
DoS / DDoS	Limitar peticiones y validar inputs.	Saturación del servidor.

📁 9. Include y Require
Instrucción	Descripción
include	Inserta un archivo (si falla, continúa).
require	Inserta un archivo (si falla, detiene ejecución).
include_once / require_once	Igual, pero solo carga una vez.

Son útiles para organizar código en módulos y reutilizar archivos comunes (encabezados, conexiones, etc.).

🧮 10. Arrays en PHP
Tipo	Ejemplo	Descripción
Normal (indexado)	["rojo", "verde"]	Índices numéricos.
Asociativo	["nombre" => "Miguel", "edad" => 22]	Claves con nombres.
Multidimensional	[["nombre" => "Ana"], ["nombre" => "Luis"]]	Arrays dentro de arrays.

🧱 11. Estructura HTML5 básica (Landing Page sin CSS ni JS)

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page - Academia de Fútbol</title>
</head>
<body>
  <header>
    <h1>Academia de Fútbol IVFC</h1>
    <nav>
      <ul>
        <li><a href="#inicio">Inicio</a></li>
        <li><a href="#nosotros">Nosotros</a></li>
        <li><a href="#galeria">Galería</a></li>
        <li><a href="#contacto">Contacto</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="inicio">
      <h2>Bienvenidos</h2>
      <p>Entrena, mejora y alcanza tu máximo potencial con nosotros.</p>
    </section>

    <section id="nosotros">
      <h2>Sobre Nosotros</h2>
      <p>Somos una academia dedicada a la formación deportiva y personal de jóvenes futbolistas.</p>
    </section>

    <section id="galeria">
      <h2>Galería</h2>
      <figure>
        <img src="img1.jpg" alt="Entrenamiento">
        <img src="img2.jpg" alt="Partido">
        <img src="img3.jpg" alt="Trofeos">
      </figure>
    </section>

    <section id="video">
      <h2>Video Promocional</h2>
      <video controls width="400">
        <source src="promo.mp4" type="video/mp4">
      </video>
    </section>

    <aside>
      <h3>Noticias</h3>
      <ul>
        <li>Nueva categoría Sub-15</li>
        <li>Inscripciones abiertas</li>
      </ul>
    </aside>

    <section id="formulario">
      <h2>Regístrate</h2>
      <form action="registro.php" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Correo:</label>
        <input type="email" name="correo" required>

        <label>Categoría:</label>
        <select name="categoria">
          <option>Sub-10</option>
          <option>Sub-15</option>
          <option>Sub-20</option>
        </select>

        <button type="submit">Registrar</button>
      </form>
    </section>
  </main>

  <footer>
    <p>© 2025 Academia IVFC. Todos los derechos reservados.</p>
  </footer>
</body>
</html>