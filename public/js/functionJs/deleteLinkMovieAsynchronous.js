//function allowing the link to be deleted to be sent to the server
jQuery(document).ready( function() {
    function deleteMovie(linkDelete) {
        $.ajax({
            url : "/deleteMovie",
            type : "POST",
            data : "name=" + linkDelete,
            dataType : "text",
            success : function(response){
                //display an message of success
                let messageSuccess = document.querySelector(".new_input_files");
                let para = document.createElement("p");
                para.textContent = response;
                para.setAttribute("class", "alert alert-success");
                messageSuccess.appendChild(para);
                jQuery("#btn_input_link").hide();
                setTimeout( function () {
                    messageSuccess.removeChild(messageSuccess.firstChild)
                }, 5000)
            },
            error : function(response, status){
                //displays an error message
                let messageError = document.querySelector(".new_input_files");
                let para = document.createElement("p");
                para.textContent = response + " : " + status;
                para.setAttribute("class", "alert alert-danger");
                messageError.appendChild(para);
                jQuery("#btn_input_link").hide();
                setTimeout( function () {
                    messageError.removeChild(messageError.firstChild)
                }, 5000)
            }
        });
    }

    jQuery(".delete_the_link").click(function (e) {
        e.preventDefault();
        let nameOfLink = $(this).attr("name");
        let linkDelete = document.querySelector(".link_id_" + nameOfLink);
        deleteMovie(nameOfLink);

        $(linkDelete).parent().remove();
    });
});
