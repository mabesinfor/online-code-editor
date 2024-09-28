<?php

setcookie("nim", "", time() - 3600);
header("Location: index.php");
die();

?>