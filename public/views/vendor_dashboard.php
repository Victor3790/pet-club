<?php 

if(empty($preference))
   return;

?>
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
              Tu dirección
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-2">
              Acerca de ti
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-3">
              Acerca de tu casa
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-4">
              Tus servicios
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-5">
              Pago de membresía
           </a>
       </li>
    </ul>
 
    <div class="tab-content">
      <div id="step-1" class="tab-pane" role="tabpanel">
            <h5>Tu dirección</h5>
            <p>Requerimos tu dirección para poder conectarte con clientes cerca de ti.</p>
            <form class="tpc-form" id="tpc_keeper_address_form" autocomplete="off">
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
       </div>
       <div id="step-2" class="tab-pane" role="tabpanel">
            <h5>Acerca de ti</h5>
            <p>Queremos conocerte mejor, cuentanos acerca de ti.</p>
            <form class="tpc-form" id="tpc_keeper_contact_form" autocomplete="off">
               <div class="form-group">
                  <div class="tpc-gender-error"></div>
                  <fieldset>
                     <p>Soy :</p>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="radio" name="tpc_gender" value="Hombre">
                        <label class="form-check-label tpc-form__radio-label gender" for="tpc_gender">
                           Hombre
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="radio" name="tpc_gender" value="Mujer">
                        <label class="form-check-label tpc-form__radio-label gender" for="tpc_gender">
                           Mujer
                        </label>
                     </div>
                  </fieldset>
               </div>
               <div class="form-group">
                  <div class="tpc-marital-status-error"></div>
                  <fieldset class="form-group">
                     <p>Estado civil:</p>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="radio" name="tpc_marital_status" value="Casado">
                        <label class="form-check-label tpc-form__radio-label" for="tpc_marital_status">
                           Casado
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="radio" name="tpc_marital_status" value="Soltero">
                        <label class="form-check-label tpc-form__radio-label" for="tpc_marital_status">
                           Soltero
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="radio" name="tpc_marital_status" value="otro">
                        <label class="form-check-label tpc-form__radio-label" for="tpc_marital_status">
                           Otro
                        </label>
                     </div>
                  </fieldset>
               </div>
               <div class="form-group">
                  <div class="tpc-occupation-error"></div>
                  <fieldset class="form-group">
                     <p>¿A qué te dedicas actualmente? Selecciona una o varias opciones.</p>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_occupation[]" value="Trabajo tiempo completo">
                        <label class="form-check-label" for="tpc_occupation[]">Trabajo tiempo completo</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_occupation[]" value="Trabajo medio tiempo">
                        <label class="form-check-label" for="tpc_occupation[]">Trabajo medio tiempo</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_occupation[]" value="Soy estudiante">
                        <label class="form-check-label" for="tpc_occupation[]">Soy estudiante</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_occupation[]" value="No trabajo">
                        <label class="form-check-label" for="tpc_occupation[]">No trabajo</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_occupation[]" value="Trabajo desde casa">
                        <label class="form-check-label" for="tpc_occupation[]">Trabajo desde casa</label>
                     </div>
                  </fieldset>
               </div>
               <div class="form-group">
                  <label class="tpc-form__label" for="tpc_birthdate_dummy">Fecha de nacimiento: </label>
                  <input class="tpc-form__input" type="text" id="tpc_birthdate_dummy" name="tpc_birthdate_dummy">
               </div>
               <div class="form-group">
                  <label class="tpc-form__label" for="tpc_home_phone">Teléfono de casa</label>
                  <input class="tpc-form__input" type="text" name="tpc_home_phone">
                  <label class="tpc-form__label" for="tpc_cellphone">Teléfono celular</label>
                  <input class="tpc-form__input" type="text" name="tpc_cellphone">
                  <?php wp_nonce_field( 'register_keeper_personal_info', 'tpc_keeper_personal_info_id', false ); ?>
                  <input type="hidden" name="action" value="tpc_register_keeper_personal_info">
                  <input type="hidden" name="tpc_birthdate" id="tpc_birthdate">
                  <input class="tpc-form__button" type="submit" value="Guardar">
               </div>
            </form>  
       </div>
       <div id="step-3" class="tab-pane" role="tabpanel">
            <h3>Tu casa</h3>
            <p>Requerimos tu información acerca del espacio donde cuidarás a las mascotas.</p>
            <form class="tpc-form" id="tpc_keeper_home_form" autocomplete="off">
               <div class="form-group">
                  <fieldset class="form-group">
                     <p>Vives en:</p>
                     <div class="tpc_home_error"></div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="radio" name="tpc_home" value="Casa">
                        <label class="form-check-label tpc-form__radio-label" for="tpc_home">
                           Casa
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="radio" name="tpc_home" value="Apartamento">
                        <label class="form-check-label tpc-form__radio-label" for="tpc_home">
                           Apartamento
                        </label>
                     </div>
                  </fieldset>
                  <fieldset class="form-group">
                     <p>Selecciona los espacios libres que tiene tu hogar.</p>
                     <div class="tpc_free_spaces_error"></div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_free_spaces[]" value="Jardín frontal">
                        <label class="form-check-label" for="tpc_free_spaces[]">Jardín frontal</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_free_spaces[]" value="Jardín trasero">
                        <label class="form-check-label" for="tpc_free_spaces[]">Jardín trasero</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_free_spaces[]" value="Cochera">
                        <label class="form-check-label" for="tpc_free_spaces[]">Cochera</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_free_spaces[]" value="Balcón">
                        <label class="form-check-label" for="tpc_free_spaces[]">Balcón</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_free_spaces[]" value="Patio">
                        <label class="form-check-label" for="tpc_free_spaces[]">Patio</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_free_spaces[]" value="Pasillos laterales">
                        <label class="form-check-label" for="tpc_free_spaces[]">Pasillos laterales</label>
                     </div>
                  </fieldset>
                  <fieldset class="form-group">
                     <p>¿Hay niños presentes?.</p>
                     <div class="tpc_kids_error"></div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="radio" name="tpc_kids" value="Sí">
                        <label class="form-check-label" for="tpc_kids">Sí</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="radio" name="tpc_kids" value="No">
                        <label class="form-check-label" for="tpc_kids">No</label>
                     </div>
                  </fieldset>
                  <fieldset class="form-group">
                     <p>¿Hay perros y / o gatos en tu casa?.</p>
                     <div class="tpc_pets_error"></div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_pets[]" value="Tengo perros">
                        <label class="form-check-label" for="tpc_pets[]">Tengo perros</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_pets[]" value="Tengo gatos">
                        <label class="form-check-label" for="tpc_pets[]">Tengo gatos</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_pets[]" value="No tengo mascotas">
                        <label class="form-check-label" for="tpc_pets[]">No tengo mascotas</label>
                     </div>
                  </fieldset>
                  <fieldset class="form-group">
                     <p>¿Permites que los perros se suban a los muebles?</p>
                     <div class="tpc_furniture_error"></div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="radio" name="tpc_furniture" value="Sí">
                        <label class="form-check-label" for="tpc_furniture">Sí</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="radio" name="tpc_furniture" value="No">
                        <label class="form-check-label" for="tpc_furniture">No</label>
                     </div>
                  </fieldset>
                  <fieldset class="form-group">
                     <p>¿Fuman dentro de tu casa?</p>
                     <div class="tpc_smoking_error"></div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="radio" name="tpc_smoking" value="Sí">
                        <label class="form-check-label" for="tpc_smoking">Sí</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="radio" name="tpc_smoking" value="No">
                        <label class="form-check-label" for="tpc_smoking">No</label>
                     </div>
                  </fieldset>
                  <h5>Sube algunas imagenes para conocerte mejor.</h5>
                  <a href="#" id="tpc_open_attachment_uploader" class="btn btn-primary">Subir imagenes</a>
                  <div class="tpc_attachments_error"></div>
                  <input type="hidden" name="tpc_attachments" id="tpc_attachments">
                  <?php wp_nonce_field( 'register_keeper_home_info', 'tpc_keeper_house_id', false ); ?>
                  <input type="hidden" name="action" value="tpc_register_keeper_house_info">
                  <input class="tpc-form__button" type="submit" value="Guardar">
               </div>
            </form> 
       </div>
       <div id="step-4" class="tab-pane" role="tabpanel">
            <h3>Los servicios que ofreces.</h3>
            <form class="tpc-form" id="tpc_keeper_services" autocomplete="off">
               <fieldset class="form-group">
                  <label class="tpc-form__label" for="tpc_experience">¿Cuántos años llevas cuidando mascotas?</label>
                  <input class="tpc-form__input" type="number" name="tpc_experience" style="width:100px;">
               </fieldset>
               <fieldset class="form-group">
                  <p>¿Tienes alguna habilidad o servicio especial? Selecciona una o varias opciones.</p>
                  <div class="tpc_abilities_error"></div>
                  <div class="form-check">
                     <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_abilities[]" value="Aplicación de inyecciones">
                     <label class="form-check-label" for="tpc_abilities[]">Aplicación de inyecciones</label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_abilities[]" value="Cuidados especiales">
                     <label class="form-check-label" for="tpc_abilities[]">Cuidados especiales</label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_abilities[]" value="Cuidado de cachorros">
                     <label class="form-check-label" for="tpc_abilities[]">Cuidado de cachorros</label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_abilities[]" value="Ninguna">
                     <label class="form-check-label" for="tpc_abilities[]">Ninguna</label>
                  </div>
               </fieldset>
               <div class="form-group">
                  <fieldset class="form-group">
                     <legend>Selecciona las máscotas que atenderás.</legend>
                     <div class="tpc_pet_client_error"></div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_pet_client[]" value="tpc_dog">
                        <label class="form-check-label" for="tpc_pet_client[]">
                           Perro
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_pet_client[]" value="tpc_cat">
                        <label class="form-check-label" for="tpc_pet_client[]">
                           Gato
                        </label>
                     </div>
                  </fieldset>
                  <fieldset class="form-group">
                     <legend>Selecciona los servicios que ofrecerás</legend>
                     <div class="tpc_service_error"></div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_service[]" value="tpc_lodging">
                        <label class="form-check-label" for="tpc_service[]">
                           Hospedaje ($200.00)
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_service[]" value="tpc_day_care">
                        <label class="form-check-label" for="tpc_service[]">
                           Guardería ($180.00)
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input tpc-form__radio" type="checkbox" name="tpc_service[]" value="tpc_walk">
                        <label class="form-check-label" for="tpc_service[]">
                           Paseo x hora ($180.00)
                        </label>
                     </div>
                  </fieldset>
                  <fieldset class="form-group">
                     <legend>Cuentanos un poco más de ti y tus servicios. (Entre 10 y 250 caracteres)</legend>
                     <div>
                        <textarea name="tpc_description" id="tpc_description" cols="30" rows="10" required></textarea>
                     </div>
                  </fieldset>
                  <h5>Selecciona una imagen para que aparezca en la parte principal de tu perfil.</h5>
                  <div class="tpc_thumbnail_error"></div>
                  <a href="#" id="tpc_open_thumbnail_uploader" class="btn btn-primary">Seleccionar</a><br>
                  <input type="hidden" name="tpc_thumbnail" id="tpc_thumbnail">
                  <?php wp_nonce_field( 'register_keeper_services', 'tpc_keeper_services_id', false ); ?>
                  <input type="hidden" name="action" value="tpc_register_keeper_services">
                  <input class="tpc-form__button" type="submit" value="Guardar">
               </div>
            </form> 
       </div>
       <div id="step-5" class="tab-pane" role="tabpanel">
         <h5>Pago de membresía</h5>
         <p>
            La membresía de The Pet Club tiene un costo de $--- pesos, la puedes pagar desde 
            Mercado Pago haciendo click en el botón de abajo.
         </p>
         <script
            src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js"
            data-preference-id="<?php echo $preference->id; ?>">
         </script>
       </div>
    </div>
</div>
 

