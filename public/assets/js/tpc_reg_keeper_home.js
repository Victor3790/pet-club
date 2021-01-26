jQuery(document).ready(function ($) {

    $('#tpc_keeper_home_form').validate({
        ignore: [],
        errorLabelContainer: '.radio-home-error',
        rules: {
            tpc_home: {
                required: true
            },
            tpc_attachments: {
                required: true
            }
        },
        messages: {
            tpc_home: {
                required: 'Por favor selecciona una opción.',
            },
            tpc_attachments: {
                required: 'Por favor sube algunas imágenes.'
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
