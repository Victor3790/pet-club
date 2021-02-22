<h1>Opciones.</h1>
<form action="options.php" method="post">
    <?php
        settings_fields( 'tpc_settings_group' );
        do_settings_sections( 'pet_club_options' );
    ?>
    <input name="submit" type="submit" value="<?php esc_attr_e( 'Save' ); ?>">
</form>