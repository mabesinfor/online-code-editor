<?php

if (!isset($_COOKIE["nim"])) header("Location: login.php");
require "connection.php";

// Dapatkan data akun
$nim = $_COOKIE["nim"];
$sql = "SELECT * FROM akun WHERE nim='$nim';";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) == 0) die("Data akun tidak ditemukan");

$row = mysqli_fetch_assoc($query);
$paket = $row["paket"];
$dir = str_replace("/","",$row["password"]);
$fulldir = "./Jawaban/" . $paket . "/" . $nim . $dir . "/";

$old = umask(0);
if (isset($_POST["file-add-submit"])) {
    $filename = $_POST["add-file-name"];
    file_put_contents($fulldir . $filename, "");
    header("Location: editor.php");
}
umask($old);

?>