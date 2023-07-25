<?php 
$servername = "localhost"; 
$username = "u681759714_ajf"; 
$password = "P^B/WKx1|cU";
$dbname = "u681759714_my_database";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>