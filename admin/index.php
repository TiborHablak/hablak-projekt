<?php
include '../admin/assets/hlavickaAdmin.php';

?>
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
                                <a class="nav-link '.'"  href="../../public/theme/'.$key.'">'.$value.'</a>
                             </li>';
                    }
                    
                ?>
                <li class="nav-item">
                <a class="nav-link" href="#">
                <form action="index.php" method="POST" class="" >
   		  		<button type="submit" name="clear-session" class="btn btn-link p-0">Odhlasiť sa</button>
				</form>	
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
<svg xmlns="http://www.w3.org/2000/svg" width="30 " height="30" fill="currentColor" class="bi bi-file-person-fill" viewBox="0 0 20 20">
  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z"/>
</svg>

					<?php 
					 echo $_SESSION['pouzivatelia']['menoUzivatela'];
					 ?>
				</h3>
				<h5 class="text-gray-dark font-weight-bold text-center">
					<?php echo $_SESSION['pouzivatelia']['rolaUzivatela']; ?>
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

    </nav>

		
				


				
				
	
	</div>
</section>


    



 

  