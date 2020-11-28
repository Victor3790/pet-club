<h3>Hola <?php echo $user_name; ?>.</h3>
<p>
   Queremos conocerte un poco mejor, 
   por favor proporciona los datos 
   que te pedimos a continuación
</p>
<div id="tpc_reg_forms">
    <ul class="nav">
       <li>
           <a class="nav-link" href="#step-1">
              Dirección
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-2">
              Contacto
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-3">
              Casa
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-4">
              Servicios
           </a>
       </li>
    </ul>
 
    <div class="tab-content">
       <div id="step-1" class="tab-pane" role="tabpanel">
            <h5>Dirección</h5>
            <p>Requerimos tu dirección para poder conectarte con clientes cerca de ti.</p>
            <form class="tpc-form" id="tpc_keeper_address_form">
               <div class="form-group">
                  <label class="tpc-form__label" for="tpc_street">Calle y número.</label>
                  <input class="tpc-form__input" type="text" name="tpc_street">
                  <label class="tpc-form__label" for="tpc_zip_code">Código postal</label>
                  <input class="tpc-form__input" type="text" name="tpc_zip_code">
                  <label class="tpc-form__label" for="tpc_colony">Colonia</label>
                  <input id="region_1" class="tpc-form__input" type="text" name="tpc_colony">
                  <?php wp_nonce_field( 'register_keeper_address', 'tpc_keeper_address_id', false ); ?>
                  <input type="hidden" name="action" value="tpc_register_keeper_address">
                  <input class="tpc-form__button" type="submit" value="Guardar">
               </div>
            </form>  

            <div class="search">
               <div class="container">
                  <div class="row">
                     <div class="col-12 col-lg-8">
                        <p class="search__title">Necesito servicio de:</p>
                        <div class="row justify-content-around">
                           <div id="lodging"
                              class="col-5 col-sm-3 col-lg-3 search__item search__item__service">
                              <i class="fas fa-suitcase search__icon"></i>
                              <p class="search__text">Hospedaje</p>
                           </div>
                           <div id="day care" 
                              class="col-5 col-sm-3 col-lg-3 search__item search__item__service">
                              <i class="fas fa-bone search__icon"></i>
                              <p class="search__text">Guardería</p>
                           </div>
                           <div id="walk" 
                              class="col-10 col-sm-3 col-lg-3 search__item search__item__service">
                              <i class="fas fa-paw search__icon"></i>
                              <p class="search__text">Paseo</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-lg-4">
                        <p class="search__title">Para mi:</p>
                        <div class="row justify-content-around">
                           <div id="dog" 
                              class="col-5 search__item search__item__pet">
                              <i class="fas fa-dog search__icon"></i>
                              <p class="search__text">Perro</p>
                           </div>
                           <div id="cat" 
                              class="col-5 search__item search__item__pet">
                              <i class="fas fa-cat search__icon"></i>
                              <p class="search__text">Gato</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col">
                        <p class="search__title">En la colonia:</p>
                           <form role="search" method="get" action="<?php echo home_url('/'); ?>">
                              <div class="form-group">
                                 <?php wp_nonce_field( 'register_keeper_contact', 'search_id', false ); ?>
                                 <input id="service" name="service" type="hidden">
                                 <input id="dog_input" name="dog" type="hidden" value=0>
                                 <input id="cat_input" name="cat" type="hidden" value=0>
                                 <input id="region" name="region" type="text">
                                 <input class="tpc-form__button" type="submit" value="Buscar">
                              </div>
                           </form> 
                     </div>
                  </div>
               </div>    
            </div>

       </div>
       <div id="step-2" class="tab-pane" role="tabpanel">
            <h5>Contacto</h5>
            <p>Requerimos tu información de contacto.</p>
            <form class="tpc-form" id="tpc_keeper_contact_form">
               <div class="form-group">
                  <label class="tpc-form__label" for="tpc_home_phone">Teléfono de casa</label>
                  <input class="tpc-form__input" type="text" name="tpc_home_phone">
                  <label class="tpc-form__label" for="tpc_cellphone">Teléfono celular</label>
                  <input class="tpc-form__input" type="text" name="tpc_cellphone">
                  <?php wp_nonce_field( 'register_keeper_contact', 'tpc_keeper_contact_id', false ); ?>
                  <input type="hidden" name="action" value="tpc_register_keeper_contact">
                  <input class="tpc-form__button" type="submit" value="Guardar">
               </div>
            </form>  
       </div>
       <div id="step-3" class="tab-pane" role="tabpanel">
            <p>Sube algunas imagenes de tu casa</p>
            <a href="#" id="tpc_open_wp_media_upload" class="btn btn-primary">Subir imagenes</a>
            <h5>Tu casa</h5>
            <p>Requerimos tu información acerca del espacio donde cuidarás a las mascotas.</p>
            <form class="tpc-form" id="tpc_keeper_home_form">
               <div class="form-group">
                  <fieldset class="form-group">
                     <legend>Vives en:</legend>
                     <div class="radio-home-error"></div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpc_home" value="Casa">
                        <label class="form-check-label tpc-form__radio-label" for="tpc_home">
                           Casa
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpc_home" value="Apartmento">
                        <label class="form-check-label tpc-form__radio-label" for="tpc_home">
                           Apartamento
                        </label>
                     </div>
                  </fieldset>
                  <fieldset class="form-group">
                     <legend>Estado civil:</legend>
                     <div class="radio-home-error"></div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpc_marital_status" value="Casado">
                        <label class="form-check-label tpc-form__radio-label" for="tpc_marital_status">
                           Casado
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpc_marital_status" value="Soltero">
                        <label class="form-check-label tpc-form__radio-label" for="tpc_marital_status">
                           Soltero
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="tpc_marital_status" value="otro">
                        <label class="form-check-label tpc-form__radio-label" for="tpc_marital_status">
                           Otro
                        </label>
                     </div>
                  </fieldset>
                  <fieldset class="form-group">
                     <legend>Tu familia:</legend>
                     <p>¿Hay niños o mascotas en tu casa? Selecciona una o varias opciones.</p>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tpc_kids" value="Niños">
                        <label class="form-check-label" for="tpc_kids">Niños</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tpc_pets" value="Mascotas">
                        <label class="form-check-label" for="tpc_pets">Mascotas</label>
                     </div>
                  </fieldset>
                  <fieldset class="form-group">
                     <legend>Habilidades especiales:</legend>
                     <p>¿Tienes alguna habilidad especial? Selecciona una o varias opciones.</p>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tpc_injection" value="Aplica inyecciones">
                        <label class="form-check-label" for="tpc_injection">Aplicación de inyecciones</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tpc_special_care" value="Cuidados especiales">
                        <label class="form-check-label" for="tpc_special_care">Cuidados especiales</label>
                     </div>
                  </fieldset>
                  <?php wp_nonce_field( 'register_keeper_home_info', 'tpc_keeper_house_id', false ); ?>
                  <input type="hidden" name="action" value="tpc_register_keeper_house_info">
                  <input class="tpc-form__button" type="submit" value="Guardar">
               </div>
            </form> 
       </div>
       <div id="step-4" class="tab-pane" role="tabpanel">
            <h5>Los servicios que ofreces.</h5>
            <p>Manejamos precios fijos, y una comisión del __%.</p>
            <form class="tpc-form" id="tpc_keeper_services">
               <div class="form-group">
                  <fieldset class="form-group">
                     <legend>Selecciona los servicios que ofrecerás</legend>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tpc_lodging" value="true">
                        <label class="form-check-label" for="tpc_lodging">
                           Hospedaje ($200.00)
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tpc_day_care" value="true">
                        <label class="form-check-label" for="tpc_day_care">
                           Guardería ($180.00)
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tpc_hour_walk" value="true">
                        <label class="form-check-label" for="tpc_hour_walk">
                           Paseo x hora ($180.00)
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tpc_half_walk" value="true">
                        <label class="form-check-label" for="tpc_half_walk">
                           Paseo 30 min ($80.00)
                        </label>
                     </div>
                  </fieldset>
                  <fieldset class="form-group">
                     <legend>Selecciona las máscotas que atenderás.</legend>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tpc_dog" value="true">
                        <label class="form-check-label" for="tpc_dog">
                           Perro
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tpc_cat" value="true">
                        <label class="form-check-label" for="tpc_cat">
                           Gato
                        </label>
                     </div>
                  </fieldset>
                  <?php wp_nonce_field( 'register_keeper_services', 'tpc_keeper_services_id', false ); ?>
                  <input type="hidden" name="action" value="tpc_register_keeper_services">
                  <input class="tpc-form__button" type="submit" value="Guardar">
               </div>
            </form> 
       </div>
    </div>
</div>
 

