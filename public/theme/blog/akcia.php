<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
date_default_timezone_get("Europe/Bratislava");


function kontrola($premenna){
	$premenna = trim($premenna);
    $premenna = htmlspecialchars($premenna);
    $premenna = stripcslashes($premenna);


	$premenna = htmlspecialchars($premenna);
	return $premenna;
}

if($_POST['odpoved'] == $_POST['spravna_odpoved']){

$suborPrispevky = fopen('prispevky.csv', 'a');

$novyPrispevok = array();


$novyPrispevok[] = $_POST['pocet'] + 1;	
$novyPrispevok[] = kontrola($_POST['meno']);
$novyPrispevok[] = kontrola($_POST['sprava']);
$novyPrispevok[] = date('Y-m-d H:i:s',time());


fputcsv($suborPrispevky, $novyPrispevok, ';');
fclose($suborPrispevky);
}
else
{
	echo "zle";
}



//header("Location: index.php");
}
 ?>
