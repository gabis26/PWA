<?php
header('Content-Type: text/html; charset=utf-8');

$dbc = mysqli_connect('localhost', 'root', '', 'El_debate') or 
die('Error connecting to MySQL server.'. mysqli_connect_error());

?>