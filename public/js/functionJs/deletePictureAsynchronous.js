//code allowing images to be deleted asynchronously via ajax
jQuery(document).ready( function() {
    jQuery('.delete_the_picture').click( function(e) {
        e.preventDefault();
        let name_of_picture = $(this).attr('name');
        let picture_delete = document.querySelector('.img_id_'+name_of_picture);
        deletePicture(name_of_picture);

        $(picture_delete).parent().remove();
    });

    function deletePicture(name_picture) {
        $.ajax({
            url : '/deletedPicture',
            type : 'POST',
            data : 'name=' + name_picture,
            dataType : 'text',

            success : function(response){
                //display an message of success
                let message_success = document.querySelector('.new_input_files');
                let para = document.createElement('p');
                para.textContent = response;
                para.setAttribute('class', "alert alert-success");
                message_success.appendChild(para);
                jQuery('#btn_input_img').hide();
                setTimeout( function () {
                    message_success.removeChild(message_success.firstChild)
                }, 5000);
            },
            error : function(response, status){
                //displays an error message
                let message_error = document.querySelector('.new_input_files');
                let para = document.createElement('p');
                para.textContent = response + ' : ' + status;
                para.setAttribute('class', "alert alert-danger");
                message_error.appendChild(para);
                jQuery('#btn_input_img').hide();
                setTimeout( function () {
                    message_error.removeChild(message_error.firstChild)
                }, 5000);
            },
        });
    }
});
