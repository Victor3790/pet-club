<?php 

if(empty($preference))
   return;

?>
<h3>Da click para pagar tu membresía</h3>
<script
   src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js"
   data-preference-id="<?php echo $preference->id; ?>">
</script>