<div class="search">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="search__title">Necesito servicio de:</p>
                <div class="row justify-content-around">
                    <div id="lodging"
                        class="col-12 col-sm-3 col-lg-3 search__item search__item__service">
                        <i class="fas fa-suitcase search__icon"></i>
                        <p class="search__text">Hospedaje</p>
                    </div>
                    <div id="day care" 
                        class="col-12 col-sm-3 col-lg-3 search__item search__item__service">
                        <i class="fas fa-bone search__icon"></i>
                        <p class="search__text">Guardería</p>
                    </div>
                    <div id="walk" 
                        class="col-12 col-sm-3 col-lg-3 search__item search__item__service">
                        <i class="fas fa-paw search__icon"></i>
                        <p class="search__text">Paseo</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="search__title">Para mi:</p>
                <div class="row justify-content-around">
                    <div id="dog" 
                        class="col-12 col-sm-3 col-lg-3 search__item search__item__pet">
                        <i class="fas fa-dog search__icon"></i>
                        <p class="search__text">Perro</p>
                    </div>
                    <div id="cat" 
                        class="col-12 col-sm-3 col-lg-3 search__item search__item__pet">
                        <i class="fas fa-cat search__icon"></i>
                        <p class="search__text">Gato</p>
                    </div>
                    <div id="other" 
                        class="col-12 col-sm-3 col-lg-3 search__item search__item__pet">
                        <i class="fas fa-crow search__icon"></i>
                        <p class="search__text">Otro</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="search__title">Tamaño:</p>
                <div class="row justify-content-around">
                    <div id="small" 
                        class="col-12 col-sm-3 col-lg-3 search__item search__item__pet">
                        <p class="search__text">Chico</p>
                        <p class="search__text"> < 10kgs </p>
                    </div>
                    <div id="medium-sized" 
                        class="col-12 col-sm-3 col-lg-3 search__item search__item__pet">
                        <p class="search__text">Mediano</p>
                        <p class="search__text"> 11 - 20kgs </p>
                    </div>
                    <div id="big" 
                        class="col-12 col-sm-3 col-lg-3 search__item search__item__pet">
                        <p class="search__text">Grande</p>
                        <p class="search__text"> 21 - 40kgs </p>
                    </div>
                    <div id="extra_big" 
                        class="col-12 col-sm-3 col-lg-3 search__item search__item__pet">
                        <p class="search__text">Gigante</p>
                        <p class="search__text"> +40kgs </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="search__title">En la colonia:</p>
                <form role="search" method="get" action="<?php echo home_url('/'); ?>">
                    <div class="form-group">
                        <?php wp_nonce_field( 'search_for_keepers', 'tpc_search_id', false ); ?>
                        <input name="post_type" type="hidden" value="keeper">
                        <input id="service" name="tpc_service" type="hidden">
                        <input id="dog_input" name="tpc_dog" type="hidden" value=0>
                        <input id="cat_input" name="tpc_cat" type="hidden" value=0>
                        <input id="other_input" name="tpc_other" type="hidden" value=0>
                        <!--<input id="region" name="tpc_region" type="text">-->
                        <select id="tpc_select_1" class="tpc-form__input" name="tpc_colony">
                            <option selected="true" disabled="disabled">
                                Seleccione
                            </option>
                            <?php foreach( $colonias as $colonia ) : ?>
                                <option value="<?php echo $colonia; ?>"><?php echo $colonia; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input class="tpc-form__button" type="submit" value="Buscar">
                    </div>
                </form> 
            </div>
        </div>
    </div>    
</div>