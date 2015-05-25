/**
 * yosli.backend.settings.js
 * Module yosliBackendSettings
 */

/*global $, yosliBackendSettings */

var yosliBackendSettings = (function () { "use strict";
    //---------------- BEGIN MODULE SCOPE VARIABLES ---------------
    var
        onFormSubmit, initModule;
    //----------------- END MODULE SCOPE VARIABLES ----------------

    //------------------- BEGIN EVENT HANDLERS --------------------
    onFormSubmit = function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        var f = $(this);

        $.post( f.attr('action'), f.serialize(), function(response) {
            if ( response.status == 'ok' ) {
                $.plugins.message('success', response.data.message);

                f.find('.submit .button').removeClass('red').addClass('green');
                $("#plugins-settings-form-status").hide()
                $("#plugins-settings-form-status span").html(response.data.message);
                $("#plugins-settings-form-status").fadeIn('slow', function() {
                    $(this).fadeOut(1000);
                });

                var yosliTab = $("#wa-app #mainmenu .tabs").find('li a[href="?plugin=yosli"]').closest('li');

                if ( $("#plugins-settings-form select[name='shop_yosli[status]']").val() === 'on' ) {
                    if (yosliTab.length === 0) {
                        $("#wa-app #mainmenu .tabs li:last").before('<li class="no-tab"><a href="?plugin=yosli">{_wp("Slider")}</a></li>');
                    }
                } else {
                    yosliTab.remove();
                }
            } else {
                $.plugins.message('error', response.errors || []);

                f.find('.submit .button').removeClass('green').addClass('red');
                $("#plugins-settings-form-status").hide();
                $("#plugins-settings-form-status span").html(response.errors.join(', '));
                $("#plugins-settings-form-status").fadeIn('slow');
            }
        }, "json");
    };
    //------------------- END EVENT HANDLERS ----------------------

    //------------------- BEGIN PUBLIC METHODS --------------------
    initModule = function () {
        $('#plugins-settings-form').on('submit', onFormSubmit);
    };

    return {
        initModule: initModule
    };
    //------------------- END PUBLIC METHODS ----------------------
}());