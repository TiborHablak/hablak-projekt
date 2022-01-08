<?php
    if(isset($_GET['text_plain']))
        list($alert['farba'],$alert['text'],$alert['icon']) = explode('::', $_GET['text_plain']);

    if(isset($_GET['application_json']))
        $alert = json_decode($_GET['application_json'],true);

    if(isset($_POST['form_data']))
        $alert = json_decode($_POST['form_data'],true);


    if(isset($alert))
    {
    ?>
        <div id="idAlert" class="alert alert-<?php echo $alert['farba']?> alert-dismissible fade show d-flex align-items-center py-2">
            <i class="bi bi-<?php echo $alert['icon']; ?>" style="font-size: 1.2rem;"></i>
            <strong class="px-2">info!!!</strong>
            <div><?php echo $alert['text']; ?></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            setTimeout(function(){

                var mojAlert = document.getElementById('idAlert');
                let alert = new bootstrap.Alert(mojAlert);
                alert.close();


            },4000);
        </script>

<?php } ?>