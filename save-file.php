<?php

if (!isset($_COOKIE["nim"])) header("Location: login.php");
require "connection.php";

$old = umask(0);
if (isset($_POST["file-save-submit"])) {
    $filename = $_POST["save-file-name"];
    $filecontent = $_POST["file-content"];
    
    file_put_contents($filename, $filecontent);
    header("Location: editor.php");
}
umask($old);

?>