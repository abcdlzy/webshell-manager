<?php
$url="./UI/index.php";
Header("HTTP/1.1 303 See Other");
Header("Location: $url");
?>