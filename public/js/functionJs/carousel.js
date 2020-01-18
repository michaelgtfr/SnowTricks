/*created by michaelgtfr
*carousel section, source: bootstrap
 */
jQuery(document).ready( function () {
    $(".carousel").carousel({interval: false});
    let numberThumb = jQuery(".thumb").length;
    for (let counter = 0; counter < numberThumb; counter++) {
        $(".thumb").eq(counter).attr("data-slide-to", counter);
    }
});