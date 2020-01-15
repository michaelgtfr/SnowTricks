//add form collection widgets for video links, operation written in the collectionWidgetVideoLink.js file

jQuery(document).ready( function() {
    jQuery ('.add-another-collection-widget-files').click( function() {
        let filesList = jQuery( jQuery(this).attr('data-list-selector'));

        let filesCounter = filesList.data('widget-files-counter') || filesList.children().length ;

        let newFilesWidget = filesList.attr('data-prototype-files');

        newFilesWidget = newFilesWidget.replace( /__name__/g, filesCounter );

        filesCounter ++ ;

        filesList.data( 'widget-files-counter', filesCounter );

        let newFilesElem = jQuery(filesList.attr('data-widget-files-tags' )).html(newFilesWidget );
        newFilesElem.appendTo(filesList );
        $("input[type=file]").change(function (e){
            $(this).next('.custom-file-label').text(e.target.files[0].name);
        });
        $(".custom-file-label" ).attr( "data-browse", "Choisir" );
    });
    jQuery ('.remove-another-collection-widget-files').click( function() {
        $('.custom-file').last().parent().remove();
    });
});