<?php
include '../admin/assets/hlavickaAdmin.php';
include '../admin/assets/navNeprihlaseny.php';

error_reporting(0);

session_start();

if (!isset($_SESSION['user']))
{
    $_SESSION['user'] = ['username' => null, 'isLoggedIn' => false];

}
if (!isset($_SESSION['pouzivatelia']))
{
    $_SESSION['pouzivatelia'] = ['menoUzivatela' => null, 'rolaUzivatela' => null];

}

?>
<?php
$meno = $_POST['meno'];
$heslo = md5($_POST['heslo']);


$servername = "localhost";
$username = "hablak";
$password = "hablak";
$db = "demo21";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

?>


<div class="container">



<?php

  
  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    $sql = 'SELECT * FROM uzivatelia WHERE login = \'' . $meno . '\' AND heslo = \'' . $heslo . '\'';
    $result = $conn->query($sql);
   
    if ($result->num_rows > 0) {

        $_SESSION['user'] = ['username' => $name, 'isLoggedIn' => true ];
        header('Location: ./index.php');
        
    }
  
  }  
  /*  
foreach ($uzivatelia as $uzivatel)
{
    list($meno, $heslo, $uzivatel, $rola) = explode('::', $uzivatel);
    $prihlasenie[$meno] = $heslo;
    $prihlasovanie[$uzivatel] = $rola;
}

$chyba = "";
*/
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
}
*/
 ?>
 


<section class=" p-5">
    <div class="container-sm border">
         <h4 class="text-sm-center font-weight-bold p-3 bg-light border"> Prihlasenie </h4>
        <form action="prihlasenie.php"  method="post" class="p-4">
            
            <div class="form-group was-validated">
                <strong class=""> Meno </strong>
                
                <input type="text" placeholder="Meno autora" class="form-control" required autocomplete=""  name="meno"  value=""> 
                <div class="invalid-feedback">
                    Zadajte prosím  meno
                </div>

            </div>
            <div class="form-group was-validated">
                <strong> Heslo </strong>
                <input type="text" placeholder="Heslo autora" class="form-control" required autocomplete=""   name="heslo"  value=""> 
                <div class="invalid-feedback">
                    Zadajte prosím správne  heslo
                </div>
            </div>
                
      <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label text-secondary" for="exampleCheck1"> Pamätať si prihlasenie</label>
  </div>

    <div class="row justify-content-md-center">
         <button type="submit" class="btn btn-light border"> Prihlasiť sa </button>
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

