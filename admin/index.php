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
$db = "demo4c";


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


        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-dark" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom mt-2"> 	<h5 class="text-white font-weight-bold text-center p-4 mt-5"> <ins>
					<?php echo $_SESSION['user']['user_info']; ?> </ins> <br>
                    <small  class="text-white font-weight-bold  "> <?php echo $_SESSION['user']['user_roll']; ?> </small> <br>
                    <svg xmlns="http://www.w3.org/2000/svg" width="150 " height="150" fill="black" class="bi bi-file-person-fill p-4" viewBox="0 0 20 20">
  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z"/>
</svg>
				</h5> 
            </div>


                <div class="list-group list-group-flush">

                <?php 
                 foreach($menu as $key => $value){

                    echo 
                         '<a class="list-group-item list-group-item-action list-group-item-light p-3"
                          href="?path='.$key.'">'.$value.'</a>';
                          
                }
                
                ?>

               
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">
                    <form action="index.php" method="POST" class="" >
              <button type="submit" name="clear-session" class="btn btn-link p-0 ">Odhlasiť sa</button>
              </form>   
              </a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
            
             
            <?php
          if($_GET['path'] === "blog"){
           ?>
                <!-- Page content-->
                <div class="container-fluid justify-content-center">
                   
                   
 
 
                  
                  <?php 
                    

$sql = "SELECT * FROM prispevky";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<table class="table table-dark table-striped  mt-5  w-75 position-center ">';
    ?>
    <tr>
      <th scope="col">MENO</th>
      <th scope="col">ČAS</th>
      <th scope="col">PRISPEVOK</th>
      <th scope="col"></th>
    </tr>
    <?php 
  while($row = mysqli_fetch_assoc($result)) {
   
    
	echo '<tr><th>' .$row["meno"]. '</th>';
	 echo '<th>' .$row["cas"]. '</th>';
	echo '<th>'
		 .prelozBBCode($row["prispevok"]);
	
   echo '</th><th>';
    ?>
    <a  href = "#" class="btn btn-danger"  data-bs-toggle="modal"data-bs-target="#modelId">Zmazať</button>
   <?php 
  echo '</th></tr>';
  }
 
  echo '</table>';
} 

?>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Naozaj chceš vymazať ? </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
      <div class="modal-body">
        <div class="container-fluid">
         
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavrieť</button>
        <button type="button" class="btn btn-primary">Zmazat JS</button>
        <a href="#" class = "btn btn-primary"> Zmazat PHP </a>
      </div>
    </div>
  </div>
</div>

<script>
  var modelId = document.getElementById('modelId');

  modelId.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      let button = event.relatedTarget;
      // Extract info from data-bs-* attributes
      let recipient = button.getAttribute('data-bs-whatever');

    // Use above variables to manipulate the DOM
  });
</script>


<?php 
}
?>


                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>



</html>



 

  