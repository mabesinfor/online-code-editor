<?php

require("connection.php");

if (isset($_POST["login"])) {
    $nim = $_POST["nim"];
    $password = $_POST["password"];

    $query = "SELECT password FROM akun WHERE nim='{$nim}'";
    $result = $conn->query($query);

    if ($result->num_rows == 0) {
        die("NIM tidak ditemukan");
    }

    $true_password = $result->fetch_column();
    
    if (!password_verify($password, $true_password)) {
        die("Password salah");
    }

    setcookie("nim", $nim, time() + 86400);
    header("Location: editor.php");
    die();
} else {
    header("Location: login.php");
    die();
}

?>