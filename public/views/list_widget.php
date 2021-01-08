<?php 

if( empty( $list_items ) || empty( $list_title ))
   return;

?>
<h3><?php echo esc_html( $list_title ); ?></h3>
<ul style="list-style-type:none;">
    <?php foreach ( $list_items as $item ) : ?>
        <li>
            <i class="fas fa-paw"></i>
            <?php echo esc_html( $item ); ?>
        </li>
    <?php endforeach; ?>
</ul>