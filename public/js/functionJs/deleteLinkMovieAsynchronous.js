//function allowing the link to be deleted to be sent to the server
jQuery(document).ready( function() {
    jQuery('.delete_the_link').click(function (e) {
        e.preventDefault();
        let name_of_link = $(this).attr('name');
        let link_delete = document.querySelector('.link_id_' + name_of_link);
        new DeleteMovie(name_of_link);

        $(link_delete).parent().remove();
    });

    function DeleteMovie(link_delete) {
        $.ajax({
            url : '/deleteMovie',
            type : 'POST',
            data : 'name=' + link_delete,
            dataType : 'text',
            success : function(response){
                //display an message of success
                let message_success = document.querySelector('.new_input_files');
                let para = document.createElement('p');
                para.textContent = response;
                para.setAttribute('class', "alert alert-success");
                message_success.appendChild(para);
                jQuery('#btn_input_link').hide();
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
                jQuery('#btn_input_link').hide();
                setTimeout( function () {
                    message_error.removeChild(message_error.firstChild)
                }, 5000);
            },
        });
    }
});
