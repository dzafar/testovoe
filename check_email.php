<?php

$conn = new mysqli('localhost', 'root', '', 'test_bd');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM contacts WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo 0;
    } else {
        echo 1;
    }

    $stmt->close();
}

$conn->close();
?>

