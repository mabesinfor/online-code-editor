<?php

if (!isset($_COOKIE["nim"])) {
    header("Location: login.php");
} else {
    header("Location: editor.php");
}

?>