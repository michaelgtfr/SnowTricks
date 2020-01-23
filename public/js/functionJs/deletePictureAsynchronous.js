//code allowing images to be deleted asynchronously via ajax
jQuery(document).ready( function() {
    function deletePicture(namePicture) {
        $.ajax({
            url : "/deletedPicture",
            type : "POST",
            data : "name=" + namePicture,
            dataType : "text",

            success(response) {
                //display an message of success
                let messageSuccess = document.querySelector(".new_input_files");
                let para = document.createElement("p");
                para.textContent = response;
                para.setAttribute("class", "alert alert-success");
                messageSuccess.appendChild(para);
                jQuery("#btn_input_img").hide();
                setTimeout( function () {
                    messageSuccess.removeChild(messageSuccess.firstChild)
                }, 5000)
            },
            error(response, status) {
                //displays an error message
                let messageError = document.querySelector(".new_input_files");
                let para = document.createElement("p");
                para.textContent = response + " : " + status;
                para.setAttribute("class", "alert alert-danger");
                messageError.appendChild(para);
                jQuery("#btn_input_img").hide();
                setTimeout( function () {
                    messageError.removeChild(messageError.firstChild)
                }, 5000)
            },
        });
    }

    jQuery(".delete_the_picture").click( function(e) {
        e.preventDefault();
        let nameOfPicture = $(this).attr("name");
        let pictureDelete = document.querySelector(".img_id_"+nameOfPicture);
        deletePicture(nameOfPicture);

        $(pictureDelete).parent().remove();
    });
});
