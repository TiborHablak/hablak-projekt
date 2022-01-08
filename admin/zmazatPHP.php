<?php 

session_start();
$_SESSION["alert"] = "active";


$servername = "localhost";
$username = "hablak";
$password = "hablak";
$db = "demo4c";

$number = intval($_GET['id']);

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM prispevky WHERE id = $number";

if ($conn->query($sql) === TRUE) {
  
header('Location: ./index.php?path=blog');
}
?>




