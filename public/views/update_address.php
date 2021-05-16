<?php
/**
 *  Dokan Dashboard Template
 *
 *  Dokan Main Dahsboard template for Fron-end
 *
 *  @since 2.4
 *
 *  @package dokan
 */

$colonias       = include TPC_PLUGIN_PATH . 'public/config/colonias.php';
$user_id        = get_current_user_id();
$keeper_post_id = get_user_meta( $user_id, 'kp_post_id', true );
$street         = get_post_meta( $keeper_post_id, 'kp_street', true );
$zip            = get_post_meta( $keeper_post_id, 'kp_zip', true );
$colony         = get_post_meta( $keeper_post_id, 'kp_colony', true );

?>
<div class="dokan-dashboard-wrap">
    <?php
        /**
         *  dokan_dashboard_content_before hook
         *
         *  @hooked get_dashboard_side_navigation
         *
         *  @since 2.4
         */
        do_action( 'dokan_dashboard_content_before' );
    ?>

    <div class="dokan-dashboard-content">

        <?php
            /**
             *  dokan_dashboard_content_before hook
             *
             *  @hooked show_seller_dashboard_notice
             *
             *  @since 2.4
             */
            do_action( 'dokan_help_content_inside_before' );
        ?>
        
        <article class="help-content-area">

            <div id="tpc_update_address">
                <ul class="nav">
                    <li>
                        <a class="nav-link" href="#step-1">
                            Tu dirección
                        </a>
                    </li>
                </ul>

                <div id="tab_container" class="tab-content">
                    <div id="step-1" class="tab-pane" role="tabpanel">
                        <form class="tpc-form" id="tpc_keeper_address_form" autocomplete="off">
                        <div class="form-group">
                            <label class="tpc-form__label" for="tpc_street">Calle y número.</label>
                            <input class="tpc-form__input" type="text" name="tpc_street" value="<?php echo $street; ?>">
                            <label class="tpc-form__label" for="tpc_zip_code">Código postal</label>
                            <input class="tpc-form__input" type="text" name="tpc_zip_code" value="<?php echo $zip; ?>">
                            <label class="tpc-form__label" for="tpc_colony">Colonia actual: <?php echo $colony; ?></label><br>
                            <select id="tpc_select_1" class="tpc-form__input" name="tpc_colony" style="width:100%;">
                                <option selected="true" disabled="disabled">
                                    Seleccione otra colonia
                                </option>
                                <?php foreach( $colonias as $colonia ) : ?>
                                    <option value="<?php echo $colonia; ?>"><?php echo $colonia; ?></option>
                                <?php endforeach; ?>
                            </select><br>
                            <?php wp_nonce_field( 'register_keeper_address', 'tpc_keeper_address_id', false ); ?>
                            <input type="hidden" name="action" value="tpc_update_keeper_address">
                            <input class="tpc-form__button" type="submit" value="Actualizar">
                        </div>
                        </form> 
                    </div>
                </div>
            </div>
        </article><!-- .dashboard-content-area -->

         <?php
            /**
             *  dokan_dashboard_content_inside_after hook
             *
             *  @since 2.4
             */
            do_action( 'dokan_dashboard_content_inside_after' );
        ?>


    </div><!-- .dokan-dashboard-content -->

    <?php
        /**
         *  dokan_dashboard_content_after hook
         *
         *  @since 2.4
         */
        do_action( 'dokan_dashboard_content_after' );
    ?>

</div><!-- .dokan-dashboard-wrap -->
