<?php 
session_start();

if (!isset($_SESSION['user']))
{
    $_SESSION['user'] = ['username' => null, 'isLoggedIn' => false, ];
}
if ($_SESSION['user']['isLoggedIn'] === false)
{
    header('Location: ../../../admin//prihlasenie.php');
}



if(isset($_POST['clear-session']))
{ 
session_destroy();
}
?>
 ?>