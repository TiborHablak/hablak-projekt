<?php
 // header('Location: ./prihlasenie.php');
include '../admin/assets/hlavickaAdmin.php';
include '../../hablak/public/assets/rozne.php';
error_reporting(0);
?>
<?php

$servername = "localhost";
$username = "hablak";
$password = "hablak";
$db = "prispevky_hablak";


$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>



<head>
  <link rel="stylesheet" href="../../hablak/admin/assets/css/style.css">
</head>
    <div class="container-fluid bg-dark">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark container sticky-top">
            <a class="navbar-brand" href="../domov">SOS Tvrdošin Prihlasenie</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>

            <div class="collapse navbar-collapse" id="collapsibleNavId">

                <ul class="navbar-nav ml-auto">

                <?php
                    $active_page = basename(dirname($_SERVER['SCRIPT_NAME']));
                   
                    $riadky = file('../public/assets/menu.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                    foreach ($riadky as $riadok) {
                        list($k,$h) = explode('::', $riadok);
                        $menu[$k] = $h;
                    }                    

                    foreach($menu as $key => $value){

                        echo '<li class="nav-item">
                                <a class="nav-link '.'"  href="../../hablak/public/theme/'.$key.'">'.$value.'</a>
                             </li>';
                    }
                    
                ?>
                <li class="nav-item">
                <a class="nav-link" href="#">
              
            
			</a>
		</li>

           
                </ul>
            </div>
         
        </nav>

     

 
    </div>
    

	<?php
	session_start();

	if (!isset($_SESSION['user']))
	{
        $_SESSION['user'] = ['username' => null, 'isLoggedIn' => false];
	}
	if ($_SESSION['user']['isLoggedIn'] === false)
	{
	    header('Location: ./prihlasenie.php');
	}
 


	?>
	<?php 
	if(isset($_POST['clear-session']))
	{ 
	session_destroy();
	}
	
    ?>


<section>
	<div class="row flex-shrink-1" >
		<div class="col-2  bg-secondary p-4 ">

			
				<h3 class="text-light text-center font-weight-bold ">
<svg xmlns="http://www.w3.org/2000/svg" width="150 " height="100" fill="currentColor" class="bi bi-file-person-fill" viewBox="0 0 20 20">
  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z"/>
</svg>

				</h3>

				<h5 class="text-gray-dark font-weight-bold text-center "> <ins>
					<?php echo $_SESSION['user']['user_info']; ?> </ins> <br>
                    <small  class="text-gray-dark font-weight-bold "> <?php echo $_SESSION['user']['user_roll']; ?> </small>
				</h5>
                
			<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar ">
        

        <ul class="list-unstyled components text-dark text-center p-5">
          
           
            <li>
                <a href="#" class="text-dark">Domov</a>
            </li>
           
            <li>
                <a href="#" class="text-dark">Správy</a>
            </li>
            <li>
                <a href="#" class="text-dark">Fotogaleria</a>
            </li>
            <li>
                <a href="#" class="text-dark">Blog</a>
            </li>
             <li>
                <a href="#" class="text-dark">O nás</a>
            </li>
           
        </ul>

        <form action="index.php" method="POST" class="" >
                <button type="submit" name="clear-session" class="btn btn-link p-0 ">Odhlasiť sa</button>
                </form> 
    </nav>

   
  

	</div>
</section>
<section>
    <div class= "container">
<?php 

$sql = "SELECT * FROM prispevky";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<table class="table mt-2">';
  while($row = mysqli_fetch_assoc($result)) {
   
	echo '<tr><th>' .$row["meno"]. '</th>';
	 echo '<th>' .$row["cas"]. '</th>';
	echo '<th>'
		 .prelozBBCode($row["prispevok"]);
	
   echo '</th><th>';
    ?>
    
    <button type="button" class="btn btn-danger">Zmazať</button>
   <?php 
  echo '</th></tr>';
  }
 
  

  echo '</table>';
} 

?>
</div>
</section>






    



 

  