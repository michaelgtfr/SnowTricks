//add form collection widgets for video links, operation written in the collectionWidgetVideoLink.js file

jQuery(document).ready( function() {
    jQuery (".add-another-collection-widget-uploadFile").click( function() {
        let uploadFileList = jQuery( jQuery(this).attr("data-list-selector"));

        let uploadFileCounter = uploadFileList.data("widget-uploadFile-counter") || uploadFileList.children().length ;

        let newUploadFileWidget = uploadFileList.attr("data-prototype-uploadFile");

        newUploadFileWidget = newUploadFileWidget.replace( /__name__/g, uploadFileCounter );

        uploadFileCounter ++ ;

        uploadFileList.data( "widget-uploadFile-counter", uploadFileCounter );

        let newUploadFileElem = jQuery(uploadFileList.attr("data-widget-uploadFile-tags" )).html(newUploadFileWidget );
        newUploadFileElem.appendTo(uploadFileList );
        $("input[type=file]").change(function (e){
            $(this).next(".custom-file-label").text(e.target.files[0].name);
        });
        $(".custom-file-label" ).attr( "data-browse", "Choisir" );
    });
    jQuery (".remove-another-collection-widget-uploadFile").click( function() {
        $(".custom-file").last().parent().remove();
    });
});