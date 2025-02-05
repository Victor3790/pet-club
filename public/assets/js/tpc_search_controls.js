jQuery(document).ready(function ($) {

    $('#tpc_select_1').select2({
        placeholder: 'Selecciona un minicipio',
        language: 'es'
    });
        
    $('.search__item__service').click( function() {

        $(this).toggleClass('search__item--active')
            .siblings().removeClass('search__item--active');
        
        $(this).children('.search__icon').toggleClass('search__icon--active');
        $(this).siblings().children('.search__icon').removeClass('search__icon--active');

        $(this).children('.search__text').toggleClass('search__text--active');
        $(this).siblings().children('.search__text').removeClass('search__text--active');

        let item_id =  $(this).attr('id');

        if( item_id == 'walk' ){
            $('#cat').hide();
            $('#cat').removeClass('search__item--active');
            $('#cat').children('.search__icon').removeClass('search__icon--active');
            $('#cat').children('.search__text').removeClass('search__text--active');
            $('#cat_input').attr('value', '0'); 
            $('#other').hide();
            $('#other').removeClass('search__item--active');
            $('#other').children('.search__icon').removeClass('search__icon--active');
            $('#other').children('.search__text').removeClass('search__text--active');
            $('#other_input').attr('value', '0');
        }else if( item_id == 'dog' && $('#cat').css('display') == 'none'  ) {
            $('#cat').removeClass('search__item--active');
            $('#cat').children('.search__icon').removeClass('search__icon--active');
            $('#cat').children('.search__text').removeClass('search__text--active');
            $('#cat_input').attr('value', '0'); 
            $('#other').removeClass('search__item--active');
            $('#other').children('.search__icon').removeClass('search__icon--active');
            $('#other').children('.search__text').removeClass('search__text--active');
            $('#other_input').attr('value', '0');
        }else{
            $('#cat').show();
            $('#other').show();
        }

        switch (item_id) {
            case 'lodging':
                $('#service').attr('value', 'kp_lodging');    
            break;

            case 'day care':
                $('#service').attr('value', 'kp_day_care');    
            break;

            case 'walk':
                $('#service').attr('value', 'kp_walk');    
            break;
        
            default:
                break;
        }
            
    });

    $('.search__item__pet').click( function() {

        $(this).toggleClass('search__item--active')
        $(this).children('.search__icon').toggleClass('search__icon--active');
        $(this).children('.search__text').toggleClass('search__text--active');

        let item_id =  $(this).attr('id');

        switch (item_id) {
            case 'dog':
                if( $('#dog').hasClass('search__item--active') )
                    $('#dog_input').attr('value', '1');    
                else
                    $('#dog_input').attr('value', '0');
            break;

            case 'cat':
                if( $('#cat').hasClass('search__item--active') )
                    $('#cat_input').attr('value', '1');    
                else
                    $('#cat_input').attr('value', '0');   
            break;

            case 'other':
                if( $('#other').hasClass('search__item--active') )
                    $('#other_input').attr('value', '1');    
                else
                    $('#other_input').attr('value', '0');   
            break;
        
            default:
                break;
        }
            
    });

    $('.search__item__size').click( function() {

        $(this).toggleClass('search__item--active')
        $(this).children('.search__icon').toggleClass('search__icon--active');
        $(this).children('.search__text').toggleClass('search__text--active');

        let item_id =  $(this).attr('id');

        switch (item_id) {
            case 'small':
                if( $('#small').hasClass('search__item--active') )
                    $('#small_input').attr('value', '1');    
                else
                    $('#small_input').attr('value', '0');
            break;

            case 'medium-sized':
                if( $('#medium-sized').hasClass('search__item--active') )
                    $('#medium-sized_input').attr('value', '1');    
                else
                    $('#medium-sized_input').attr('value', '0');   
            break;

            case 'big':
                if( $('#big').hasClass('search__item--active') )
                    $('#big_input').attr('value', '1');    
                else
                    $('#big_input').attr('value', '0');   
            break;

            case 'extra-big':
                if( $('#extra-big').hasClass('search__item--active') )
                    $('#extra-big_input').attr('value', '1');    
                else
                    $('#extra-big_input').attr('value', '0');   
            break;
        
            default:
                break;
        }
            
    });


});