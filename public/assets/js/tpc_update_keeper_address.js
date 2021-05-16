jQuery(document).ready(function ($) {

    $('#tpc_select_1').select2({
        placeholder: 'Selecciona un minicipio',
        language: 'es'
    });

    $('#tpc_keeper_address_form').validate({
        rules: {
            tpc_street: {
                required: true,
                rangelength: [10,70]
            },
            tpc_zip_code: {
                required: true,
                rangelength: [5,5],
                digits: true
            }
        },
        messages: {
            tpc_street: {
                required: 'Por favor ingresa tu calle.',
                rangelength: jQuery
                            .validator
                            .format("La calle debe tener entre {0} y {1} caracteres. &nbsp;")
            },
            tpc_zip_code: {
                required: 'Por favor ingresa tu código postal.',
                rangelength: jQuery
                            .validator
                            .format("El código postal debe tener {0} dígitos. &nbsp;"),
                digits: 'El código postal no puede tener letras.'
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
                $('#tpc_update_address').smartWizard('loader', 'show');
            },
            onSuccess: function(result){
                location.reload();
                $('#tpc_reg_forms').tpc_wizard_success(result);
            },
            onError: function (){
                $('#tpc_reg_forms').tpc_wizard_error();
            }
        });
    }

});
