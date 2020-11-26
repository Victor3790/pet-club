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
    });
});