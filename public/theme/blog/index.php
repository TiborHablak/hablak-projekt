<?php

include '../../assets/header.php';
include '../../assets/menu.php';
include '../../assets/rozne.php';
error_reporting(0);


$servername = "localhost";
$username = "hablak";
$password = "hablak";
$db = "demo4c";


$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>




<?php

$chyba = "";
$meno = "";
$sprava = "";
$kontrola = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
$kontrola = kontrola($_POST['sprava'])

?>

<?php

$name = kontrola($_POST['meno']);
$message =  kontrola($_POST['sprava']);


    if (kontrola($_POST['odpoved']) == $_POST['spravna_odpoved'] && !empty($kontrola))
    {
		$sql = "INSERT INTO `prispevky`(`meno`, `prispevok`) VALUES (\"$name\" , \"$message\")";
		if ($conn->query($sql) === TRUE) {
		
		  } else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		  }
     //   $suborPrispevky = fopen('prispevky.csv', 'a');

     //   $novyPrispevok = array();

      //  $novyPrispevok[] = $_POST['pocet'] + 1;
      //  $novyPrispevok[] = kontrola($_POST['meno']);
       // $novyPrispevok[] = kontrola($_POST['sprava']);
      //  $novyPrispevok[] = date('Y-m-d H:i:s', time());

      //  fputcsv($suborPrispevky, $novyPrispevok, ';');
      //  fclose($suborPrispevky);
    }
    else
    {
        $chyba = "Nespravna odpoved na otazku, alebo je prispevok prazdny";
        $meno = kontrola($_POST['meno']);

    }

?>

<?php
    if (!empty($chyba))
    {

?>	

<div class="alert alert-danger alert-dismissible fade show" role="alert">
 <strong> Ups! </strong> <?php echo $chyba; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php
    } ?>

<?php
    if (empty($chyba))
    {

?>	

<div class="alert alert-success alert-dismissible fade show" role="alert">
 <strong> Výborne </strong> <?php echo "Uspešne sme pridali váš názor" ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


<?php
    }

}
?>



<?php

$suborCaptcha = file('captcha.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$antiSpam = [];

for ($i = 0;$i < count($suborCaptcha);$i += 2)
{

    $antiSpam[str_replace("odpoved: ", "", $suborCaptcha[$i + 1]) ] = str_replace("otazka: ", "", $suborCaptcha[$i]);

}

$vybranyKluc = array_rand($antiSpam);
//echo $vybranyKluc;
$prispevky = [];
$suborPrispevky = fopen('prispevky.csv', 'r');

/*
while ($prispevok = fgetcsv($suborPrispevky, 1000, ';'))
{
    $prispevky[] = $prispevok;
}

fclose($suborPrispevky);

$prispevky = array_reverse($prispevky);
*/
?>





<section>
	

	<div class="container">

	<div class ="row">
			<div class ="col-md-10">
			<h1 class="py-3 text-center">Blog na Tému: </h1>
			</div>
				</div>

		<form action="index.php"  method="post">
		<div class ="row">
			<div class ="col-md-10">
				<div class="form-group was-validated">

				<small id="emailHelp" class="form-text text-muted">Napište nam svoje meno</small>
				<input type="text" placeholder="Meno autora" class="form-control" required autocomplete="" 	pattern="\S.{4,19}" name="meno"  value="<?php echo $meno ?>"> 
				<div class="invalid-feedback">
					Prosim vyplnte túto položku. Zadajte 5-20 znakov!
				</div>
				</div>
			</div>
		</div>
	<div class ="row mt-2">	
		<div class ="col-md-10">
			<div class="form-group was-validated ">
				 <small id="emailHelp" class="form-text text-muted">Povedzte nam svoj názor</small>
				<textarea name="sprava"  cols="98" rows="5" placeholder="Váš text" class="form-control" required><?php echo $sprava ?></textarea>
			</div>
		</div>	
	</div>	
		
			<div class="form-group">
					 <small> Antispam: <?php echo $antiSpam[$vybranyKluc] ?> </small> 
			 <div class="form-group was-validated">

			 	<div class="row mt-2" >	
						<div class="col-md-8"> <input type="text" placeholder="Odpoveď" class="form-control just" required name="odpoved" pattern="<?php echo $vybranyKluc ?>" > </div>
						<div class="col-md-2">
												 <button type="reset" class="btn btn-primary float-right">Vynulovať </button>
												 <button type="submit" class="btn btn-primary float-right">Odoslať </button>
										
						</div>
					
					 
				</div>
				
		</div>
		
		<input type="hidden" name="spravna_odpoved" value="<?php echo $vybranyKluc ?>">
		<input type="hidden" name="pocet" value="<?php echo count($prispevky) ?>">
			
		
		</form>
		
	</div>


	
	<div class="container mt-5">
		<?php

$sql = "SELECT * FROM prispevky";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
	echo '<div class ="row"> <div class ="col-md-10">';
	echo ' <h4>' .$row["meno"]. '</h4>';
	 echo '<small><i>  Odoslane: ' .$row["cas"]. '</i></small>';
	echo '<br>'
		 .prelozBBCode($row["prispevok"]);
	'';
	echo '<hr> </div></div>';
	
  }
} 



/*
foreach ($prispevky as $prispevok)
{
    $datum = strtotime($prispevok[3]);
    $datumTxt = date('j. ', $datum) . $mesiace[date('n', $datum) - 1] . date(' Y H:i', $datum);

?>	
			<h4><?php echo $prispevok[1] ?></h4>
			<small><i> Odoslane: <?php echo $datumTxt ?></i></small>
			<p>
				<?php echo prelozBBCode(nl2br($prispevok[2])) ?>
			</p>
			<hr>
		<?php
}*/
?>
	</div>
</section>

<?php
include '../../assets/footer.php';
?>
