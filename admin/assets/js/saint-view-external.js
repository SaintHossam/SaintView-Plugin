
// To activate external plugins



jQuery(function ($) {
    'use strict';


    $('.icon_picker').iconpicker();



    //tab
    jQuery('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
    jQuery('.tab ul.tabs li a').on('click', function (g) {
        var tab = jQuery(this).closest('.tab'),
            index = jQuery(this).closest('li').index();
        tab.find('ul.tabs > li').removeClass('current');
        jQuery(this).closest('li').addClass('current');
        tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
        tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
        g.preventDefault();
    });

});