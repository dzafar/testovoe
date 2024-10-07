<?php
$conn = new mysqli('localhost', 'root', '', 'test_bd');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("SELECT * FROM contacts WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO contacts (name, phone, email, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $phone, $email, $message);
        $stmt->execute();

        $to = 'ncpremote@mail.ru';
        $subject = 'Новое сообщение от ' . $name;
        $headers = "From: ncpremote@mail.ru\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
        $emailMessage = "Имя: $name\nТелефон: $phone\nE-mail: $email\nСообщение: $message";
        mail($to, $subject, $emailMessage, $headers);
        echo "Пользователь зарегестрированн " . $emailMessage;
    } else {
        echo "ошибка";
    }

    $stmt->close();
}

$conn->close();

?>