jQuery(document).ready(function($) {
    // magnific popup
    $('a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]').each(function(){
        //single image popup
        if ($(this).parents('.gallery').length == 0) {
            $(this).magnificPopup({
                type: 'image',
                image: {
                    markup: '<div class="mfp-figure">' +
                        '<div class="mfp-close"></div>' +
                        '<div class="mfp-img"></div>' +
                        '<div class="mfp-bottom-bar">' +
                        '<div class="mfp-title"></div>' +
                        '<div class="mfp-description"></div>' +
                        '<div class="mfp-counter"></div>' +
                        '</div>' +
                        '</div>',
                    titleSrc: function(item) {
                        return '<span>' + item.el.find('img').attr('alt') + '</span>';
                    }
                }
            });
        }
    });
    // gallery images with captions
    $('.gallery').magnificPopup({
        delegate: 'a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]',
        type: 'image',
        image: {
            markup: '<div class="mfp-figure">'+
            '<div class="mfp-close"></div>'+
            '<div class="mfp-img"></div>'+
            '<div class="mfp-bottom-bar">'+
            '<div class="mfp-title"></div>'+
            '<div class="mfp-description"></div>'+
            '<div class="mfp-counter"></div>'+
            '</div>'+
            '</div>',
            titleSrc: function(item) {
                return '<span>' + item.el.find('img').attr('alt') + '</span>';
            }
        },
        gallery: {
            enabled: true,
            navigateByImgClick: true
        }
    });
});
