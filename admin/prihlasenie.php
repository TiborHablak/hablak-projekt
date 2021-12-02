<?php
include '../admin/assets/hlavickaAdmin.php';
include '../admin/assets/navNeprihlaseny.php';

error_reporting(0);

session_start();

?>
<?php
$meno = $_POST['meno'];
$heslo = md5($_POST['heslo']);
$chyba = "";

$servername = "localhost";
$username = "hablak";
$password = "hablak";
$db = "demo4c";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
<head>
  <link rel="stylesheet" href="../../hablak/admin/assets/css/style.css">
</head>
<div class="container">


<?php 
  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    $sql = 'SELECT * FROM uzivatelia WHERE login = \'' . $meno . '\' AND heslo = \'' . $heslo . '\'';
    $result = $conn->query($sql);
   
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $priezvisko = $row['meno'];
        $rola_id = $row['rola'];
      }
    
      
        $_SESSION['user'] = ['username' => $name, 'isLoggedIn' => true, 'user_info' => $priezvisko, 'user_roll' => $rola_id];
     header('Location: ./index.php');
 
    }  else
    $chyba = "nespravne meno alebo heslo!";

  }  
?>

<?php
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    foreach ($prihlasenie as $name => $password)
    {
        if ($name === $_POST['meno'] && $password === $_POST['heslo'])
        {
            
                $_SESSION['user'] = ['username' => $name, 'isLoggedIn' => true ];
                foreach ($prihlasovanie as $meno => $rola) {
                    if($rola === $name){
                            $_SESSION['pouzivatelia'] = ['menoUzivatela' => $meno, 'rolaUzivatela' => $rola ];
                    }
                }

                header('Location: ./index.php');
        }
          else
        $chyba = "nespravne meno alebo heslo!";
    }
*/

if(!empty($chyba)){

?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">
 <strong> !!! </strong> <?php echo $chyba; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php 
}
 ?>
 
<section class="p-5">
    <div class="container p-0 border">
         <h4 class="text-sm-center font-weight-bold p-3 bg-light border justify-content-center"> Prihlasenie </h4>
        <form action="prihlasenie.php"  method="post" class="p-4">
            
            <div class="form-group was-validated mt-2">
                <strong class=""> Meno </strong>
                
                <input type="text" placeholder="Meno autora" class="form-control" required autocomplete=""  name="meno"  value=""> 
                <div class="invalid-feedback">
                    Zadajte prosím  meno
                </div>

            </div>
            <div class="form-group was-validated mt-4">
                <strong> Heslo </strong>
                <input type="password" placeholder="Heslo autora" class="form-control" required autocomplete=""   name="heslo"  value=""> 
                <div class="invalid-feedback">
                    Zadajte prosím správne  heslo
                </div>
            </div>
                
      <div class="mt-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label text-secondary" for="exampleCheck1"> Pamätať si prihlasenie</label>
  </div>

    <div class="row mt-2">
      <div class =" col-md-6">
         <button type="submit" class="btn btn-light border"> Prihlasiť sa </button>
         </div>
    </div>
    <br><br>
        <div class="row justify-content-md-center">
        <span>  <a href="#">Zaregistruj sa </a></span>
    </div>
        <div class="row justify-content-md-center">
            <span class="">Zabudol si <a href="#">heslo?</a></span>
    </div>


                
        </div>  
    </form>
    </div>
 <?php
include '../admin/assets/paticka.php';
?>

