jQuery(document).ready(function ($) {

    $('#tpc_open_wp_media_upload').click(function(){

        media_uploader = wp.media({
            title: 'Selecciona una imagen',
            frame: 'select',
            multiple: 'false',
            library: {
                type: 'image/jpeg'
            },
            button: {
                text: 'Subir'
            }
        });

        media_uploader.open();

        media_uploader.on( 'select', function(){ 
                attachment = media_uploader.state().get('selection').first().toJSON();
                console.log(attachment.id); 
            });
    });
});