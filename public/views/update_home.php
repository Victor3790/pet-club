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

$user_id        = get_current_user_id();
$keeper_post_id = get_user_meta( $user_id, 'kp_post_id', true );
$house          = get_post_meta( $keeper_post_id, 'kp_house', true );
$spaces         = get_post_meta( $keeper_post_id, 'kp_free_spaces', true );
$kids           = get_post_meta( $keeper_post_id, 'kp_kids', true );
$pets           = get_post_meta( $keeper_post_id, 'kp_pets', true );
$furniture      = get_post_meta( $keeper_post_id, 'kp_furniture', true );
$smoking        = get_post_meta( $keeper_post_id, 'kp_smoking', true );

$home_options = array(
    'Casa',
    'Apartamento'
);

$space_options = array(
    'Jardín frontal',
    'Jardín trasero',
    'Cochera',
    'Balcón',
    'Patio',
    'Pasillos laterales'
);

$yes_no = array(
    'Sí',
    'No'
);

$pet_options = array(
    'Tengo perros',
    'Tengo gatos',
    'No tengo mascotas'
);

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

            <div id="tpc_update_home">
                <ul class="nav">
                    <li>
                        <a class="nav-link" href="#step-1">
                            Tu casa
                        </a>
                    </li>
                </ul>

                <div id="tab_container" class="tab-content">
                    <div id="step-1" class="tab-pane" role="tabpanel">
                        <h3>Tu casa</h3>
                        <form class="tpc-form" id="tpc_keeper_home_form" autocomplete="off">
                            <div class="form-group">
                                <fieldset class="form-group">
                                    <p>Vives en:</p>
                                    <div class="tpc_home_error"></div>

                                    <?php foreach ( $home_options as $option ) : ?>
                                        
                                        <div class="form-check">
                                            <input  class="form-check-input tpc-form__radio" 
                                                    type="radio" 
                                                    name="tpc_home" 
                                                    value="<?php echo $option; ?>"
                                                    <?php if ( $option === $house ) echo 'checked="checked"'; ?>
                                            >
                                            <label class="form-check-label tpc-form__radio-label" for="tpc_home">
                                                <?php echo $option; ?>
                                            </label>
                                        </div>

                                    <?php endforeach; ?>

                                </fieldset>
                                <fieldset class="form-group">
                                    <p>Selecciona los espacios libres que tiene tu hogar.</p>
                                    <div class="tpc_free_spaces_error"></div>

                                    <?php foreach ( $space_options as $option ) : ?>
                                        
                                        <div class="form-check">
                                            <input  class="form-check-input tpc-form__radio" 
                                                    type="checkbox" 
                                                    name="tpc_free_spaces[]" 
                                                    value="<?php echo $option; ?>"
                                                    <?php if ( in_array( $option, $spaces, true ) ) echo 'checked="checked"'; ?>
                                            >
                                            <label class="form-check-label" for="tpc_free_spaces[]">
                                                <?php echo $option; ?>
                                            </label>
                                        </div>

                                    <?php endforeach; ?>

                                </fieldset>
                                <fieldset class="form-group">
                                    <p>¿Hay niños presentes?.</p>
                                    <div class="tpc_kids_error"></div>

                                    <?php foreach ( $yes_no as $option ) : ?>
                                        
                                        <div class="form-check">
                                            <input  class="form-check-input tpc-form__radio" 
                                                    type="radio" 
                                                    name="tpc_kids" 
                                                    value="<?php echo $option; ?>"
                                                    <?php if ( $option === $kids ) echo 'checked="checked"'; ?>
                                            >
                                            <label class="form-check-label tpc-form__radio-label" for="tpc_kids">
                                                <?php echo $option; ?>
                                            </label>
                                        </div>

                                    <?php endforeach; ?>

                                </fieldset>
                                <fieldset class="form-group">
                                    <p>¿Hay perros y / o gatos en tu casa?.</p>
                                    <div class="tpc_pets_error"></div>

                                    <?php foreach ( $pet_options as $option ) : ?>

                                        <div class="form-check">
                                                <input  class="form-check-input tpc-form__radio" 
                                                        type="checkbox" 
                                                        name="tpc_pets[]" 
                                                        value="<?php echo $option; ?>"
                                                        <?php if ( in_array( $option, $pets, true ) ) echo 'checked="checked"'; ?>
                                                >
                                                <label class="form-check-label" for="tpc_pets[]">
                                                    <?php echo $option; ?>
                                                </label>
                                        </div>

                                    <?php endforeach; ?>

                                </fieldset>
                                <fieldset class="form-group">
                                    <p>¿Permites que los perros se suban a los muebles?</p>
                                    <div class="tpc_furniture_error"></div>

                                    <?php foreach ( $yes_no as $option ) : ?>
                                        
                                        <div class="form-check">
                                            <input  class="form-check-input tpc-form__radio" 
                                                    type="radio" 
                                                    name="tpc_furniture" 
                                                    value="<?php echo $option; ?>"
                                                    <?php if ( $option === $furniture ) echo 'checked="checked"'; ?>
                                            >
                                            <label class="form-check-label tpc-form__radio-label" for="tpc_furniture">
                                                <?php echo $option; ?>
                                            </label>
                                        </div>

                                    <?php endforeach; ?>

                                </fieldset>
                                <fieldset class="form-group">
                                    <p>¿Fuman dentro de tu casa?</p>
                                    <div class="tpc_smoking_error"></div>

                                    <?php foreach ( $yes_no as $option ) : ?>
                                        
                                        <div class="form-check">
                                            <input  class="form-check-input tpc-form__radio" 
                                                    type="radio" 
                                                    name="tpc_smoking" 
                                                    value="<?php echo $option; ?>"
                                                    <?php if ( $option === $smoking ) echo 'checked="checked"'; ?>
                                            >
                                            <label class="form-check-label tpc-form__radio-label" for="tpc_smoking">
                                                <?php echo $option; ?>
                                            </label>
                                        </div>

                                    <?php endforeach; ?>

                                </fieldset>
                                <?php wp_nonce_field( 'update_keeper_home_info', 'tpc_keeper_house_id', false ); ?>
                                <input type="hidden" name="action" value="tpc_update_keeper_house_info">
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
