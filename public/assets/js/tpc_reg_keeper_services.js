jQuery(document).ready(function ($) {

    $('#dog_checkbox').change(function(){
        $('#tpc_dog_weight_controls').toggle();
    });

    $('#tpc_lodging_select').change(function(){
        $('#tpc_lodging_qty').toggle();
    });

    $('#tpc_day_care_select').change(function(){
        $('#tpc_day_care_qty').toggle();
    });

    $('#tpc_walk_select').change(function(){
        $('#tpc_walk_qty').toggle();
    });

    $('#tpc_keeper_services').validate({
        ignore: [],
        rules: {
            tpc_experience: {
                required: true,
                range: [ 0, 50 ]
            },
            'tpc_abilities[]' : {
                required: true
            },
            'tpc_pet_client[]' : {
                required: true
            },
            'tpc_service[]' : {
                required: true
            },
            tpc_description: {
                required: true,
                rangelength: [10,250]
            },
            tpc_thumbnail: {
                required: true
            }
        },
        messages: {
            tpc_experience: {
                required: 'Por favor dinos cuántos años llevas cuidando mascotas.',
                range:  jQuery
                        .validator
                        .format("Número entre {0} y {1} . &nbsp;")
            },
            'tpc_abilities[]' : {
                required: 'Selecciona una o varias opciones'
            },
            'tpc_pet_client[]' : {
                required: 'Selecciona las mascotas que atenderás'
            },
            'tpc_service[]' : {
                required: 'Selecciona uno o varios servicios.'
            },
            tpc_description: {
                required: 'Por favor ingresa información tuya y de tus servicios.',
                rangelength: jQuery
                            .validator
                            .format("La descripción debe tener entre {0} y {1} caracteres. &nbsp;")
            },
            tpc_thumbnail: {
                required: 'Por favor selecciona una imagen para tu perfil.'
            }
        },
        errorPlacement: function( error, element ) {
            if( element.attr( 'name' ) === 'tpc_abilities[]' ) {
                error.appendTo( '.tpc_abilities_error' );
            }
            else if( element.attr( 'name' ) === 'tpc_pet_client[]' ) {
                error.appendTo( '.tpc_pet_client_error' );
            }
            else if( element.attr( 'name' ) === 'tpc_service[]' ) {
                error.appendTo( '.tpc_service_error' );
            }
            else if( element.attr( 'name' ) === 'tpc_thumbnail' ) {
                error.appendTo( '.tpc_thumbnail_error' );
            }
            else {
                error.insertAfter( element );
            }
        },
        submitHandler: function (form) {
            tpc_submit(event, form)
        }
    });

    function tpc_submit( event, form )
    {
        event.preventDefault();
        $(form).vk_ajax_send({
            url: tpc_object.ajax_url,
            start: function() {
                $('#tpc_reg_forms').smartWizard('loader', 'show');
            },
            onSuccess: function(result){
                $('#tpc_reg_forms').tpc_wizard_success(result);
            },
            onError: function (){
                $('#tpc_reg_forms').tpc_wizard_error();
            }
        });
    }

});
