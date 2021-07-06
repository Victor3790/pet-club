jQuery(document).ready( function( $ ){
    
    let control_counter = 0;

    $('#tpc-pet-data').on( 'click', '#add-pet', function() {
        
        control_counter++;
        tmp_inputs = pet_inputs;

        tmp_inputs = tmp_inputs.replace( /0/g, control_counter );
        $('#tpc-pet-inputs').append( tmp_inputs );

    });

    $('#tpc-pet-data').on( 'click', '.pet-data__button--delete', function() {

        $(this).parent().remove();

    });

    $('#tpc_I_have_dogs').change( function(){
        
        show_pet_data_inputs();

    });

    $('#tpc_I_have_cats').change( function(){
        
        show_pet_data_inputs();

    });

    function show_pet_data_inputs()
    {

        let dogs    = $('#tpc_I_have_dogs')[0].checked;
        let cats    = $('#tpc_I_have_cats')[0].checked;
        let items   = $('#tpc-pet-data').children().length;

        if( ( dogs || cats ) && items === 0 ) {

            $('#tpc-pet-data').append( first_pet_input );
            $('#tpc-pet-data').css( 'padding', '20px 50px' );
            $('#tpc-pet-data').toggle( 'slow' );
            toggle_scroll()

        }
        else if( ( !dogs && !cats ) && items !== 0 ) {

            $('#tpc-pet-data').toggle( 'slow', function() {

                $('#tpc-pet-inputs-container').remove();
                $('#tpc-pet-data').css( 'padding', '0' );
                toggle_scroll()

            });

        }

    }

    function toggle_scroll()
    {
        let tpc_scroll = $('#tab_container').css( 'overflow' );
        let tpc_checked = $('#tpc-pet-data').children().length;

        if( tpc_scroll === 'scroll' && tpc_checked > 0 )
            return;
        
        if( tpc_scroll !== 'scroll' && tpc_checked > 0 )
            $('#tab_container').css( 'overflow', 'scroll' );
        
        if( tpc_scroll !== 'hidden' && tpc_checked === 0 )
            $('#tab_container').css( 'overflow', 'hidden' );
    }

    let first_pet_input =   '<div id="tpc-pet-inputs-container">' +
                                '<div class="pet-data__inputs" id="tpc-pet-inputs">' +
                                    '<div id="pet_input_set_0" class="pet-data__input-set">' +
                                        '<label for="pets[0][name]">Nombre:&nbsp;</label>' +
                                        '<input class="pet-data__name" name="pets[0][name]" type="text" required>&nbsp;' +
                                        '<label for="pets[0][age]">Edad:&nbsp;</label>' +
                                        '<input class="pet-data__age" name="pets[0][age]" type="number" required>&nbsp;' +
                                        '<a href="#" class="pet-data__button pet-data__button--pic">' +
                                        '<i class="fa fa-image"></i></a>' +
                                        '<input class="pet-data__pic" name="pets[0][pic]" type="hidden" required>&nbsp;' +
                                    '</div>' +
                                '</div>' +
                                '<span id="add-pet" class="pet-data__button pet-data__button--add">+ Añadir</span>' +
                            '</div>';

    let pet_inputs =    '<div id="pet_input_set_0" class="pet-data__input-set">' +
                            '<label for="pets[0][name]">Nombre:&nbsp;</label>' +
                            '<input class="pet-data__name" name="pets[0][name]" type="text" required>&nbsp;' +
                            '<label for="pets[0][age]">Edad:&nbsp;</label>' +
                            '<input class="pet-data__age" name="pets[0][age]" type="number" required>&nbsp;' +
                            '<a href="#" class="pet-data__button pet-data__button--pic">' +
                            '<i class="fa fa-image"></i></a>&nbsp;' +
                            '<span class="pet-data__button pet-data__button--delete">' +
                            '<i class="fa fa-trash" aria-hidden="true"></i></span>' +
                            '<input class="pet-data__pic" name="pets[0][pic]" type="hidden" required>&nbsp;' +
                        '</div>';

});
