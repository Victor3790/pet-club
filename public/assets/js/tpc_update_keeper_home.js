jQuery(document).ready(function ($) {

    $('#tpc_keeper_home_form').validate({
        ignore: [],
        rules: {
            tpc_home: {
                required: true
            },
            'tpc_free_spaces[]': {
                required: true
            },
            tpc_kids: {
                required: true
            },
            'tpc_pets[]': {
                required: true
            },
            tpc_furniture: {
                required: true
            },
            tpc_smoking: {
                required: true
            }
        },
        messages: {
            tpc_home: {
                required: 'Por favor selecciona el lugar donde vives.'
            },
            'tpc_free_spaces[]': {
                required: 'Por favor selecciona uno o más espacios'
            },
            tpc_kids: {
                required: 'Por favor selecciona "Sí" o "No"'
            },
            'tpc_pets[]': {
                required: 'Por favor selecciona una o varias opciones'
            },
            tpc_furniture: {
                required: 'Por favor selecciona "Sí" o "No"'
            },
            tpc_smoking: {
                required: 'Por favor selecciona "Sí" o "No"'
            }
        },
        errorPlacement: function ( error, element ) {
            if( element.attr( 'name' ) === 'tpc_home' ) {
                error.appendTo( '.tpc_home_error' );
            }
            else if( element.attr( 'name' ) === 'tpc_free_spaces[]' ) {
                error.appendTo( '.tpc_free_spaces_error' );
            }
            else if( element.attr( 'name' ) === 'tpc_kids' ) {
                error.appendTo( '.tpc_kids_error' );
            }
            else if( element.attr( 'name' ) === 'tpc_pets[]' ) {
                error.appendTo( '.tpc_pets_error' );
            }
            else if( element.attr( 'name' ) === 'tpc_furniture' ) {
                error.appendTo( '.tpc_furniture_error' );
            }
            else if( element.attr( 'name' ) === 'tpc_smoking' ) {
                error.appendTo( '.tpc_smoking_error' );
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
                $('#tpc_update_home').smartWizard('loader', 'show');
            },
            onSuccess: function(result){
                $('#tpc_update_home').tpc_wizard_success(result);
            },
            onError: function (){
                $('#tpc_update_home').tpc_wizard_error();
            }
        });
    }

});
