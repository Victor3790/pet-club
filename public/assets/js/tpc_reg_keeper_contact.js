jQuery(document).ready(function ($) {

    $.datepicker.setDefaults( $.datepicker.regional[ 'es' ] );
    $( '#tpc_birthdate_dummy' ).datepicker({
      altField:  '#tpc_birthdate',
      //altFormat: 'yy-mm-dd'
    });

    $('#tpc_keeper_contact_form').validate({
        rules: {
            tpc_gender: {
                required: true
            },
            tpc_marital_status: {
                required: true
            },
            'tpc_occupation[]': {
                required: true
            },
            tpc_birthdate_dummy: {
                required: true
            },
            tpc_home_phone: {
                required: true,
                rangelength: [10,10],
                digits: true
            },
            tpc_cellphone: {
                required: true,
                rangelength: [10,10],
                digits: true
            }
        },
        errorPlacement: function( error, element ) {
            if( element.attr('name') === 'tpc_gender' ) {
                error.appendTo( '.tpc-gender-error' );
            }
            else if( element.attr('name') === 'tpc_marital_status' ) {
                error.appendTo( '.tpc-marital-status-error' );
            }
            else if( element.attr('name') === 'tpc_occupation[]' ) {
                error.appendTo( '.tpc-occupation-error' );
            } 
            else {
                error.insertAfter( element );
            }
        },
        messages: {
            tpc_gender: {
                required: 'Por favor selecciona un género.'
            },
            tpc_marital_status: {
                required: 'Por favor selecciona tu estado civil.'
            },
            'tpc_occupation[]': {
                required: 'Por favor selecciona una o varias opciones.'
            },
            tpc_birthdate_dummy: {
                required: 'Por favor ingresa tu fecha de nacimiento.'
            },
            tpc_home_phone: {
                required: 'Por favor ingresa tu número de casa.',
                rangelength: jQuery
                            .validator
                            .format("El número debe tener {0} digitos. &nbsp;"),
                digits: 'El número telefónico no puede tener letras.'
            },
            tpc_cellphone: {
                required: 'Por favor ingresa tu número celular.',
                rangelength: jQuery
                            .validator
                            .format("El número debe tener {0} digitos. &nbsp;"),
                digits: 'El número telefónico no puede tener letras.'
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

    /* Inicialización en español para la extensión 'UI date picker' para jQuery. */
    /* Traducido por Vester (xvester@gmail.com). */
    ( function( factory ) {
        if ( typeof define === "function" && define.amd ) {

            // AMD. Register as an anonymous module.
            define( [ "../widgets/datepicker" ], factory );
        } else {

            // Browser globals
            factory( jQuery.datepicker );
        }
    }( function( datepicker ) {

    datepicker.regional.es = {
        closeText: "Cerrar",
        prevText: "&#x3C;Ant",
        nextText: "Sig&#x3E;",
        currentText: "Hoy",
        monthNames: [ "enero","febrero","marzo","abril","mayo","junio",
        "julio","agosto","septiembre","octubre","noviembre","diciembre" ],
        monthNamesShort: [ "ene","feb","mar","abr","may","jun",
        "jul","ago","sep","oct","nov","dic" ],
        dayNames: [ "domingo","lunes","martes","miércoles","jueves","viernes","sábado" ],
        dayNamesShort: [ "dom","lun","mar","mié","jue","vie","sáb" ],
        dayNamesMin: [ "D","L","M","X","J","V","S" ],
        weekHeader: "Sm",
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: "" };
    datepicker.setDefaults( datepicker.regional.es );

    return datepicker.regional.es;

    } ) );

});
