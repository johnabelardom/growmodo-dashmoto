window.addEventListener('load', ls_wc_js_functions);

function ls_wc_js_functions() {
    var ajax_url = '/wp-admin/admin-ajax.php';

    jQuery('form.ls_wc.register').on('submit', function(e) {
        e.preventDefault();

        jQuery.ajax({
            url: ajax_url,
            data: jQuery('form.ls_wc.register').serialize() + '&action=ls_wc_register',
            type: 'POST',
        }).done(function(response) {
            jQuery('form.ls_wc.register').trigger('reset');
        })
    });

    jQuery('form.ls_wc.login').on('submit', function(e) {
        e.preventDefault();

        jQuery.ajax({
            url: ajax_url,
            data: jQuery('form.ls_wc.login').serialize() + '&action=ls_wc_login',
            type: 'POST',
        }).done(function(response) {
            jQuery('form.ls_wc.login').trigger('reset');
        })
    });

}