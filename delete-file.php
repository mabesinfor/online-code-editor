<?php

if (!isset($_COOKIE["nim"])) header("Location: login.php");
require "connection.php";

$old = umask(0);
if (isset($_POST["file-delete-submit"])) {
    $filename = $_POST["delete-file-name"];
    unlink($filename);
    header("Location: editor.php");
}
umask($old);

?>