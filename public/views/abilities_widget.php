<?php 

if(empty($abilities))
   return;

?>
<ul style="list-style-type:none;">
    <?php foreach ( $abilities as $ability ) : ?>
        <li>
            <i class="fas fa-paw"></i>
            <?php echo esc_html( $ability ); ?>
        </li>
    <?php endforeach; ?>
</ul>