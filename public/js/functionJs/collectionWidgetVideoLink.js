//add form collection widgets for video links

jQuery(document).ready( function() {
    jQuery (".add-another-collection-widget").click( function() {
        let list = jQuery( jQuery(this).attr("data-list-selector"));
        // Try to find the counter of the list or use the length of the list
        let counter = list.data("widget-counter") || list.children().length ;
        // grab the prototype template
        let newWidget = list.attr("data-prototype");
        // replace the "__name__" used in the id and name of the prototype
        // with a number that"s unique to your movie
        // end name attribute looks like name="contact[linkUploaded][2]"
        newWidget = newWidget.replace( /__name__/g, counter );
        // Increase the counter
        counter ++ ;
        // And store it, the length cannot be used if deleting widgets is allowed
        list.data( "widget-counter", counter );

        // create a new list element and add it to the list
        let newElem = jQuery(list.attr("data-widget-tags" )).html(newWidget );
        newElem.appendTo(list );
    });
    jQuery (".remove-another-collection-widget").click( function() {
        $(".movies-box").last().parent().remove();
    });
});