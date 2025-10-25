Documentación de las Tablas y Relaciones
📚 TABLA BOOK
Elementos y Tipos:
isbn (VARCHAR(13), PRIMARY KEY): Identificador único internacional para libros

title (VARCHAR(255), NOT NULL): Título completo del libro

publisher (VARCHAR(100)): Casa editorial que publicó el libro

publication_year (INT): Año de publicación

pages (INT): Número total de páginas

language (VARCHAR(50)): Idioma principal del libro

Justificación:
ISBN como PK: Es único internacionalmente y identifica inequívocamente cada libro

VARCHAR(255) para Título: Suficiente espacio para títulos largos

Campos opcionales: Editorial, Año, etc., pueden ser NULL si no se conocen

👤 TABLA AUTHOR
Elementos y Tipos:
author_id (INT, PRIMARY KEY, AUTO_INCREMENT): Identificador único interno

first_name (VARCHAR(100), NOT NULL): Primer nombre del autor

last_name (VARCHAR(100), NOT NULL): Apellido del autor

country (VARCHAR(50)): Nacionalidad del autor

birth_date (DATE): Fecha de nacimiento

Justificación:
AUTO_INCREMENT: Simplifica la inserción de nuevos autores

Nombre y Apellido separados: Permite búsquedas y ordenamientos flexibles

DATE para FechaNacimiento: Tipo específico para fechas

🔗 TABLA BOOK_AUTHOR (TABLA DE RELACIÓN)
Elementos y Tipos:
isbn (VARCHAR(13), FOREIGN KEY)

author_id (INT, FOREIGN KEY)

PRIMARY KEY (isbn, author_id): Clave compuesta

Relación y Justificación:
Relación Muchos a Muchos: Un libro puede tener múltiples autores, un autor puede escribir múltiples libros

Clave compuesta: Evita duplicados de la misma relación libro-autor

ON DELETE CASCADE: Si se elimina un libro o autor, se eliminan sus relaciones

📖 TABLA COPY
Elementos y Tipos:
copy_id (INT, PRIMARY KEY, AUTO_INCREMENT): Identificador único de cada copia física

isbn (VARCHAR(13), FOREIGN KEY, NOT NULL): Libro al que pertenece

copy_number (INT, NOT NULL): Número secuencial por libro

status (ENUM): Estado actual del ejemplar

acquisition_date (DATE): Cuando se adquirió

location (VARCHAR(50)): Ubicación física en la biblioteca

Justificación:
Separación Libro/Ejemplar: Un libro (información) vs múltiples copias físicas

ENUM para Estado: Valores controlados y predefinidos

UNIQUE KEY (isbn, copy_number): Garantiza numeración única por libro

👥 TABLA USER
Elementos y Tipos:
user_id (INT, PRIMARY KEY, AUTO_INCREMENT): Identificador interno

dni (VARCHAR(20), UNIQUE, NOT NULL): Documento nacional de identidad

first_name (VARCHAR(100), NOT NULL): Primer nombre

last_name (VARCHAR(100), NOT NULL): Apellido

email (VARCHAR(255), UNIQUE): Correo electrónico

phone (VARCHAR(15)): Número de contacto

address (TEXT): Dirección completa (TEXT para direcciones largas)

registration_date (DATE, DEFAULT CURRENT_DATE): Fecha de registro automática

user_type (ENUM): Categoría del usuario

Justificación:
DNI UNIQUE: Garantiza unicidad del documento

TEXT para Direccion: Espacio flexible para direcciones largas

DEFAULT CURRENT_DATE: Registro automático de fecha

🔄 TABLA LOAN
Elementos y Tipos:
loan_id (INT, PRIMARY KEY, AUTO_INCREMENT): Identificador único del préstamo

copy_id (INT, FOREIGN KEY, NOT NULL): Ejemplar prestado

user_id (INT, FOREIGN KEY, NOT NULL): Usuario que toma prestado

loan_date (DATE, NOT NULL): Fecha de inicio

due_date (DATE, NOT NULL): Fecha límite

return_date (DATE, NULL): Fecha real de devolución

status (ENUM): Estado actual del préstamo

Relación y Justificación:
Relación con Ejemplar: Cada préstamo es de un ejemplar específico

Relación con Usuario: Cada préstamo es a un usuario específico

Fechas separadas: Permite tracking del ciclo de préstamo

Estado dinámico: Puede cambiar durante la vida del préstamo

⚠️ TABLA FINE
Elementos y Tipos:
fine_id (INT, PRIMARY KEY, AUTO_INCREMENT): Identificador único

loan_id (INT, FOREIGN KEY, NOT NULL): Préstamo que generó la multa

amount (DECIMAL(8,2), NOT NULL): Cantidad a pagar

start_date (DATE, NOT NULL): Cuando se aplicó

payment_date (DATE, NULL): Cuando se pagó (NULL si no pagada)

status (ENUM): Estado de pago

reason (VARCHAR(255)): Razón de la multa

Relación y Justificación:
Relación con Préstamo: Cada multa está asociada a un préstamo específico

DECIMAL para Monto: Precisión en valores monetarios

FechaPago NULL: Permite tracking de multas pendientes

🔗 RESUMEN DE RELACIONES
Book (1) → (N) Copy - Un libro tiene muchos ejemplares

Book (N) ←→ (N) Author - Muchos a muchos mediante Book_Author

Copy (1) → (N) Loan - Un ejemplar tiene muchos préstamos en el tiempo

User (1) → (N) Loan - Un usuario tiene muchos préstamos

Loan (1) → (N) Fine - Un préstamo puede generar múltiples multas