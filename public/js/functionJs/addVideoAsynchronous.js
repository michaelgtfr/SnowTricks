//modification of the images in the browser and in the database asynchronously
jQuery(document).ready( function () {
    //function processing links
    function manageLink(inputMovie, url, preview, blockInput) {
        while(preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }
        let src = url.value;

        if(src.length === 0) {
            let para = document.createElement("p");
            para.textContent = "Aucun lien actuellement sélectionné pour le téléchargement";
            para.setAttribute("class", "alert alert-danger");
            preview.appendChild(para);
        } else if (src.startsWith("http") === false) {
            let para = document.createElement("p");
            para.textContent = "Désolé mais votre lien ne suis pas les critères demandés, " +
                "veuillez prendre un lien commençant par 'http'";
            para.setAttribute("class", "alert alert-danger");
            preview.appendChild(para);
        } else {
            while (blockInput.firstChild) {
                blockInput.removeChild(blockInput.firstChild);
            }
            //filter youtube
            src = src.replace(/watch\?v=/g, "embed/");

            let movie = inputMovie.querySelector("iframe");
            $(movie).attr("src", src);
            movie.setAttribute("class", "new_link");

            jQuery("#btn_input_link").show();
        }
    }
    //Function allowing to send it to the server
    function linkUpload(nameLinkModify, srcLinkModify) {
        $.ajax({
            url : "/modifiedLinkProcessing",
            type : "POST",
            data : "name=" + nameLinkModify +
                "&src=" + srcLinkModify,
            dataType : "text",

            success(response) {
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
            error() {
                //displays an error message
                let response = "désoler une erreur à eu lieu";
                let status = 500;
                let messageError = document.querySelector(".new_input_files");
                let para = document.createElement("p");
                para.textContent = response + " : " + status;
                para.setAttribute("class", "alert alert-danger");
                messageError.appendChild(para);
                jQuery("#btn_input_link").hide();
                setTimeout( function () {
                    messageError.removeChild(messageError.firstChild)
                }, 5000)
            },
        });
    }

    $("#btn_input_link").hide();

    // display the video modification button
    jQuery(".add_the_input_movie").click(function(e) {
        let nameOfMovie = $(this).attr("name");

        jQuery(".new_input_files").append("<div class=\"preview\">\n" +
            "    <p class=\"alert alert-warning\">Aucun lien envoyer pour le moment, " +
            "attention à envoyer un lien commençant par 'http' ou 'https'.</p>\n" +
            "  </div><div class=\"form-group\">" +
            "<label for=\"input_new_url\">Nouveau lien</label>" +
            "<input type=\"url\" " +
            "id=\"input_new_url\" " +
            "class=\"input_new_url form-control\" " +
            "name=\""+ nameOfMovie +"\"/>" +
            "<button id=\"fileSelectMovie\" class=\"btn btn-warning\"> Valider le lien </button></div>");
        e.preventDefault();

        //modification to the link in the browser
        jQuery("#fileSelectMovie").click( function () {
            let blockInputMovie = document.querySelector(".link_id_"+nameOfMovie);
            let urlSelect = document.querySelector("#input_new_url");
            let preview = document.querySelector(".preview");
            let blockInput = document.querySelector(".new_input_files");

            manageLink(blockInputMovie, urlSelect, preview, blockInput);
        });
    });

    //retrieving the different modified links
    jQuery("#btn_input_link").click( function(e) {
        e.preventDefault();
        let newLink = document.querySelectorAll(".new_link");
        for (let i = 0; i < newLink.length; i++) {
            linkUpload(newLink[i].name, newLink[i].src);
        }
    });
});