ТЗ выбло связанно с отправкой формы на почту, тут я ошибочно не сделал фильтр под вредоносный код, СКАНДАЛ.

php 7.4
mySql 8.0

В файлах process_form.php и check_email.php подправить переменную $conn

создание бд

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); 
