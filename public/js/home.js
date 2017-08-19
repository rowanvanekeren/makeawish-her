$(function() {

    // Init Masonry
    var opts = {
        itemSelector: '.block',
        columnWidth: '.block',
        gutter: 25,
        percentPosition: true,
        transitionDuration: 0
    }
    var $grid = jQuery('.index-images-wrapper').masonry(opts);

    // Position and show image as it loads
    jQuery('.index-images-wrapper').imagesLoaded().progress(function(imgLoadData, elem ){
        jQuery(elem.img).closest('.block').css('opacity', 1);
        $grid.masonry('layout');
    });
});