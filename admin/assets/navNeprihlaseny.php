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
                                <a class="nav-link '.'" href="../../hablak/public/theme/'.$key.'">'.$value.'</a>
                             </li>';
                    }
                    
                ?>
       <li class="nav-item">
              
        </li>
                </ul>
            </div>
        </nav>
    </div>
    