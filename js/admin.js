jQuery(document).ready(function() {
	jQuery('.ocpsw_colorpicker').wpColorPicker();

	jQuery('ul.ocpsw-tabs li').click(function() {
        var tab_id = jQuery(this).attr('data-tab');
        jQuery('ul.ocpsw-tabs li').removeClass('ocpsw-current');
        jQuery('.ocpsw-tab-content').removeClass('ocpsw-current');
        jQuery(this).addClass('ocpsw-current');
        jQuery("#"+tab_id).addClass('ocpsw-current');
    });

    jQuery('#ocpsw_disbl_atch_for_ord_status').select2({
        ajax: {
                url: ajaxurl,
                dataType: 'json',
                delay: 200,
                allowClear: true,
                data: function (params) {
                    return {
                        q: params.term,
                        action: 'ocpsw_search_ord_status'
                    };
                },
                processResults: function( data ) {
                    var options = [];
                    if ( data ) {
                        jQuery.each( data, function( index, text ) { 
                            options.push( { id: text[0], text: text[1]} );
                        });
                    }
                    return {
                        results: options
                    };
                },
                cache: true
        },
        minimumInputLength: 1
    });


    jQuery('#ocpsw_atch_to_email').select2({
    });
});