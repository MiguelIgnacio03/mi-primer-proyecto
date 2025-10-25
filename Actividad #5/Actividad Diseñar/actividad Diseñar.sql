-- Crear la base de datos
CREATE DATABASE Library;
USE Library;

-- 1. TABLE BOOK
CREATE TABLE Book (
    isbn VARCHAR(13) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    publisher VARCHAR(100),
    publication_year INT,
    pages INT,
    language VARCHAR(50)
);

-- 2. TABLE AUTHOR
CREATE TABLE Author (
    author_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    country VARCHAR(50),
    birth_date DATE
);

-- 3. TABLE BOOK_AUTHOR (Many-to-many relationship)
CREATE TABLE Book_Author (
    isbn VARCHAR(13),
    author_id INT,
    PRIMARY KEY (isbn, author_id),
    FOREIGN KEY (isbn) REFERENCES Book(isbn) ON DELETE CASCADE,
    FOREIGN KEY (author_id) REFERENCES Author(author_id) ON DELETE CASCADE
);

-- 4. TABLE COPY
CREATE TABLE Copy (
    copy_id INT PRIMARY KEY AUTO_INCREMENT,
    isbn VARCHAR(13) NOT NULL,
    copy_number INT NOT NULL,
    status ENUM('Available', 'Borrowed', 'Under Maintenance', 'Lost'),
    acquisition_date DATE,
    location VARCHAR(50),
    FOREIGN KEY (isbn) REFERENCES Book(isbn) ON DELETE CASCADE,
    UNIQUE KEY (isbn, copy_number)
);

-- 5. TABLE USER
CREATE TABLE User (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    dni VARCHAR(20) UNIQUE NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE,
    phone VARCHAR(15),
    address TEXT,
    registration_date DATE DEFAULT CURRENT_DATE,
    user_type ENUM('Student', 'Professor', 'Staff')
);

-- 6. TABLE LOAN
CREATE TABLE Loan (
    loan_id INT PRIMARY KEY AUTO_INCREMENT,
    copy_id INT NOT NULL,
    user_id INT NOT NULL,
    loan_date DATE NOT NULL,
    due_date DATE NOT NULL,
    return_date DATE NULL,
    status ENUM('Active', 'Returned', 'Overdue'),
    FOREIGN KEY (copy_id) REFERENCES Copy(copy_id),
    FOREIGN KEY (user_id) REFERENCES User(user_id)
);

-- 7. TABLE FINE
CREATE TABLE Fine (
    fine_id INT PRIMARY KEY AUTO_INCREMENT,
    loan_id INT NOT NULL,
    amount DECIMAL(8,2) NOT NULL,
    start_date DATE NOT NULL,
    payment_date DATE NULL,
    status ENUM('Pending', 'Paid'),
    reason VARCHAR(255),
    FOREIGN KEY (loan_id) REFERENCES Loan(loan_id)
);