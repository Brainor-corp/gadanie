(function( $ ) {
    'use strict';

    $(function() {


        var plugin_name = 'clearfy';

        if (typeof $('.color-input').wpColorPicker === 'function') {
            $('.color-input').wpColorPicker();
        }


        /********************************************************************
         * Clear log
         *******************************************************************/
        $('.js-clearfy-clear-log').on('click', function(){

            var $this = $(this);

            if ( confirm( 'Are you sure?' ) ) {

                $this.attr('disabled', true).text('process...');

                var ajaxdata = {
                    action : 'clearfy_clear_log',
                    import_settings: $('textarea[name=import_settings]').val(),
                    import_settings_name: $('input[name=import_settings_name]').val(),
                    _wpnonce : $this.data('nonce')
                };

                jQuery.post( ajaxurl, ajaxdata, function( response ) {
                    if (response == 'ok') {
                        $this.attr('disabled', false).text('OK');
                        $('.clearfy-table-404').remove();
                    }
                });

            }

        });


        /********************************************************************
         * Import settings
         *******************************************************************/
        $('.js-import-settings-clearfy').on('click', function(){

            var $this = $(this);

            if ( confirm( 'Are you sure?' ) ) {

                var ajaxdata = {
                    action : 'wpshop_plugin_import_settings',
                    import_settings: $('textarea[name=import_settings]').val(),
                    import_settings_name: $('input[name=import_settings_name]').val(),
                    _wpnonce : $this.data('nonce')
                };

                jQuery.post( ajaxurl, ajaxdata, function( response ) {
                    if ( response == 'ok' ) {
                        createCookie( 'plugin_import_settings_success', '1');
                        window.location.reload();
                    } else {
                        alert(response);
                    }
                });

            }
            return false;
        });


        /********************************************************************
         * Redirect Manager
         *******************************************************************/
        $(document).on('click', '.js-redirect-manager-add', function() {
            redirect_manager_add();
        });
        $(document).on('click', '.js-redirect-manager-delete', function() {
            if ( $('.js-redirect-manager-item').length > 1 ) {
                $(this).parent().slideUp(100, function () {
                    $(this).remove();
                });
            } else {
                $(this).parent().find('input').val('');
            }
        });
        $(document).bind('change', '.js-redirect-manager-item:last input:first', function() {
            if ( $('.js-redirect-manager-item:last input:first').val() != '' ) {
                redirect_manager_add();
            }
            $('.js-redirect-manager-item input').unbind();
        });
        function redirect_manager_add() {
            var $new_item = $('.js-redirect-manager-item').first().clone();
            $new_item.find('input').val('');
            $('.redirect-manager-list').append($new_item);
        }


        /**
         * Pseudo checkbox
         */
        $('.pseudo-checkbox').on('click', function() {
            var $checkbox = $(this).next();

            if ( $checkbox.attr('id') == 'redirect_from_http_to_https' && ! $checkbox.is(":checked") ) {
                if ( ! confirm( 'Вы уверенны, что Ваш сайт поддерживает https?' ) ) {
                    return;
                }
            }

            $(this).toggleClass('checked');

            if ( $checkbox.is(":checked") ) {
                $checkbox.attr("checked", false);
            } else {
                $checkbox.attr("checked", true);
            }

        });

        $('.pseudo-checkbox-hidden').on('change', function(){
            $(this).prev().toggleClass('checked');
        });

        $('.pseudo-checkbox-hidden').on('focus', function(){
            $(this).prev().addClass('focused');
        });

        $('.pseudo-checkbox-hidden').on('blur', function(){
            $(this).prev().removeClass('focused');
        });






        $('.js-wpshop-instruction-expand').click(function(){
            $('.js-wpshop-instruction-body').slideToggle();
        });


        /**
         * Tabs
         */
        if (readCookie("tab-" + plugin_name) != null) {
            var tab_id = readCookie("tab-" + plugin_name);
            var $tab = $('.js-' + plugin_name + ' #' + tab_id);

            if ($tab.length) {
                $('.js-wpshop-tab-wrapper a').removeClass('wpshop-tab-active');
                $('.js-' + plugin_name + ' #tab-' + tab_id + '').addClass('wpshop-tab-active');

                jQuery('.js-wpshop-tab-item').removeClass('active');
                jQuery("#" + tab_id).addClass('active');
            }
        }

        $('.js-' + plugin_name).on('click', '.js-wpshop-tab-wrapper a', function () {
            jQuery('.js-wpshop-tab-wrapper').find('a').removeClass('wpshop-tab-active');
            jQuery(this).addClass('wpshop-tab-active');

            createCookie("tab-" + plugin_name, jQuery(this).attr("id").replace("tab-", ""));

            jQuery('.js-wpshop-tab-item').removeClass('active');
            jQuery("#" + jQuery(this).attr("id").replace("tab-", "")).addClass('active');

            return false;
        });

        /**
         * Tabs
         */
        /*if (readCookie("clearfy-tab") != null) {
            var tab_id = readCookie("clearfy-tab");
            var $tab = $('#' + tab_id);

            if ($tab.length) {
                $('.js-tab-wrapper a').removeClass('nav-tab-active');
                $('#' + tab_id + '-tab').addClass('nav-tab-active');

                $('.js-tab-item').removeClass('active');
                $tab.addClass('active');
            }
        }

        jQuery('.js-tab-wrapper a').click(function () {
            jQuery('.js-tab-wrapper').find('a').removeClass('nav-tab-active');
            jQuery(this).addClass('nav-tab-active');

            createCookie("clearfy-tab", jQuery(this).attr("id").replace("-tab", ""));

            jQuery('.js-tab-item').removeClass('active');
            jQuery("#" + jQuery(this).attr("id").replace("-tab", "")).addClass('active');
        });*/

        /**
         * Top buttons
         */
        jQuery('.js-clearfy-recommend').click(function(){
            jQuery('.js-clearfy-form').find(':checkbox').prop('checked', false);
            $('.pseudo-checkbox').removeClass('checked');

            jQuery('.clearfy-recommend').parents('.option-field').find('input').prop('checked', true);
            jQuery('.clearfy-recommend').parents('.option-field').find('.pseudo-checkbox').addClass('checked');
        });

        jQuery('.js-clearfy-enable').click(function(){
            jQuery('.js-clearfy-form').find(':checkbox').prop('checked', true);
            jQuery('.js-clearfy-form').find('.auto-enable-false').find(':checkbox').prop('checked', false);
            $('.pseudo-checkbox').addClass('checked');
            jQuery('.js-clearfy-form').find('.auto-enable-false').find('.pseudo-checkbox').prop('checked', false);
            jQuery('.js-clearfy-form').find('.auto-enable-false').find('.pseudo-checkbox').removeClass('checked');
        });

        jQuery('.js-clearfy-disable').click(function(){
            jQuery('.js-clearfy-form').find(':checkbox').prop('checked', false);
            $('.pseudo-checkbox').removeClass('checked');
        });

    });

})( jQuery );

function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    /* NDc4MjU0 */
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}
