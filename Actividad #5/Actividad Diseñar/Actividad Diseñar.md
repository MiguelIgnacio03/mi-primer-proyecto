📚 SISTEMA DE GESTIÓN DE BIBLIOTECA
🔷 DIAGRAMA CONCEPTUAL (Entidad-Relación)
text
[LIBRO] -----< [EJEMPLAR] >----- [PRÉSTAMO] -----< [USUARIO]
   |                                |
   |                                |
   |                              [MULTA]
   |
   |
<AUTOR_LIBRO> -----< [AUTOR]
🔷 ESQUEMA RELACIONAL
1. TABLA LIBRO (1FN, 2FN, 3FN)
sql
CREATE TABLE Libro (
    ISBN VARCHAR(13) PRIMARY KEY,
    Titulo VARCHAR(255) NOT NULL,
    Editorial VARCHAR(100),
    AnioPublicacion INT,
    Paginas INT,
    Idioma VARCHAR(50)
);
2. TABLA AUTOR (1FN, 2FN, 3FN)
sql
CREATE TABLE Autor (
    AutorID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Apellido VARCHAR(100) NOT NULL,
    PaisOrigen VARCHAR(50),
    FechaNacimiento DATE
);
3. TABLA AUTOR_LIBRO (Tabla de relación muchos a muchos)
sql
CREATE TABLE Autor_Libro (
    ISBN VARCHAR(13),
    AutorID INT,
    PRIMARY KEY (ISBN, AutorID),
    FOREIGN KEY (ISBN) REFERENCES Libro(ISBN),
    FOREIGN KEY (AutorID) REFERENCES Autor(AutorID)
);
4. TABLA EJEMPLAR (1FN, 2FN, 3FN)
sql
CREATE TABLE Ejemplar (
    EjemplarID INT PRIMARY KEY AUTO_INCREMENT,
    ISBN VARCHAR(13) NOT NULL,
    NumeroEjemplar INT NOT NULL,
    Estado ENUM('Disponible', 'Prestado', 'En Reparación', 'Perdido'),
    FechaAdquisicion DATE,
    Ubicacion VARCHAR(50),
    FOREIGN KEY (ISBN) REFERENCES Libro(ISBN),
    UNIQUE KEY (ISBN, NumeroEjemplar)
);
5. TABLA USUARIO (1FN, 2FN, 3FN)
sql
CREATE TABLE Usuario (
    UsuarioID INT PRIMARY KEY AUTO_INCREMENT,
    DNI VARCHAR(20) UNIQUE NOT NULL,
    Nombre VARCHAR(100) NOT NULL,
    Apellido VARCHAR(100) NOT NULL,
    Email VARCHAR(255) UNIQUE,
    Telefono VARCHAR(15),
    Direccion TEXT,
    FechaRegistro DATE DEFAULT CURRENT_DATE,
    TipoUsuario ENUM('Estudiante', 'Profesor', 'Personal')
);
6. TABLA PRÉSTAMO (1FN, 2FN, 3FN)
sql
CREATE TABLE Prestamo (
    PrestamoID INT PRIMARY KEY AUTO_INCREMENT,
    EjemplarID INT NOT NULL,
    UsuarioID INT NOT NULL,
    FechaPrestamo DATE NOT NULL,
    FechaDevolucionPrevista DATE NOT NULL,
    FechaDevolucionReal DATE NULL,
    Estado ENUM('Activo', 'Devuelto', 'Vencido'),
    FOREIGN KEY (EjemplarID) REFERENCES Ejemplar(EjemplarID),
    FOREIGN KEY (UsuarioID) REFERENCES Usuario(UsuarioID)
);
7. TABLA MULTA (1FN, 2FN, 3FN)
sql
CREATE TABLE Multa (
    MultaID INT PRIMARY KEY AUTO_INCREMENT,
    PrestamoID INT NOT NULL,
    Monto DECIMAL(8,2) NOT NULL,
    FechaInicio DATE NOT NULL,
    FechaPago DATE NULL,
    Estado ENUM('Pendiente', 'Pagada'),
    Motivo VARCHAR(255),
    FOREIGN KEY (PrestamoID) REFERENCES Prestamo(PrestamoID)
);
✅ APLICACIÓN DE LAS TRES FORMAS NORMALES
PRIMERA FORMA NORMAL (1FN)
✓ Todos los atributos son atómicos

✓ No hay grupos repetitivos

✓ Cada tabla tiene clave primaria

✓ Ejemplo: En Autor, nombre y apellido separados

SEGUNDA FORMA NORMAL (2FN)
✓ Cumple 1FN

✓ Todos los atributos no clave dependen completamente de la clave primaria

✓ Ejemplo: En Ejemplar, todos los atributos dependen de EjemplarID

TERCERA FORMA NORMAL (3FN)
✓ Cumple 2FN

✓ No hay dependencias transitivas

✓ Ejemplo: En Usuario, no hay dependencias entre atributos no clave

🔑 CLAVES Y RELACIONES
CLAVES PRIMARIAS:
Libro(ISBN)

Autor(AutorID)

Ejemplar(EjemplarID)

Usuario(UsuarioID)

Prestamo(PrestamoID)

Multa(MultaID)

CLAVES FORÁNEAS:
Autor_Libro(ISBN) → Libro(ISBN)

Autor_Libro(AutorID) → Autor(AutorID)

Ejemplar(ISBN) → Libro(ISBN)

Prestamo(EjemplarID) → Ejemplar(EjemplarID)

Prestamo(UsuarioID) → Usuario(UsuarioID)

Multa(PrestamoID) → Prestamo(PrestamoID)

📊 DIAGRAMA RELACIONAL DETALLADO
text
LIBRO (ISBN, Titulo, Editorial, AnioPublicacion, Paginas, Idioma)
    ↑
AUTOR_LIBRO (ISBN, AutorID) [FK: ISBN→LIBRO, AutorID→AUTOR]
    ↑
AUTOR (AutorID, Nombre, Apellido, PaisOrigen, FechaNacimiento)
    ↑
EJEMPLAR (EjemplarID, ISBN, NumeroEjemplar, Estado, FechaAdquisicion, Ubicacion)
    ↑
PRÉSTAMO (PrestamoID, EjemplarID, UsuarioID, FechaPrestamo, FechaDevolucionPrevista, FechaDevolucionReal, Estado)
    ↑
USUARIO (UsuarioID, DNI, Nombre, Apellido, Email, Telefono, Direccion, FechaRegistro, TipoUsuario)
    ↑
MULTA (MultaID, PrestamoID, Monto, FechaInicio, FechaPago, Estado, Motivo)