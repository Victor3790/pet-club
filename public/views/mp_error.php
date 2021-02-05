<?php 

if(empty($error_message))
   return;

?>
<h3>Error</h3>
<p>
    Ha habido un error, por favor contacta a servicio al cliente.
</p>
<p>
    <?php echo $error_message; ?>
</p>