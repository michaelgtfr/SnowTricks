//file processing images asynchronously
jQuery(document).ready( function() {

    //function to send it to the server
    function fileUpload(img, file) {
        $.ajax({
            url : "/modifiedImageProcessing",
            type : "POST",
            data : "name=" + img.name +
                "&src=" + img.src +
                "&type=" + file["type"],
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
                    messageSuccess.removeChild(messageSuccess.firstChild);
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
                    messageError.removeChild(messageError.firstChild);
                }, 5000)
            },
        });
    }

    //function use of the page.
    function handleFiles(selectedFile, preview, nameOfPictureModify, nameOfPicture, blockNewInput ) {
        while(preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }

        let files = selectedFile.files;
        if(files.length === 0) {
            let para = document.createElement("p");
            para.textContent = "Aucun fichier actuellement sélectionné pour le téléchargement";
            preview.appendChild(para);
        } else if (files[0].size > 2000000) {
            $(".preview").show();
            let para = document.createElement("p");
            para.textContent = "Désoler votre fichier ne suis pas les critères demandés (jpg, jpeg, png, 2mo).";
            para.setAttribute("class", "alert alert-danger");
            preview.appendChild(para);
        } else {
            while (nameOfPictureModify.firstChild) {
                nameOfPictureModify.removeChild(nameOfPictureModify.firstChild);
            }
            while (blockNewInput.firstChild) {
                blockNewInput.removeChild(blockNewInput.firstChild);
            }

            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                let imageType = /^image\//;

                if (!imageType.test(file.type)) {
                    continue;
                }

                let img = document.createElement("img");
                img.classList.add("obj");
                img.setAttribute("name", nameOfPicture);
                img.setAttribute("class", "obj col-sm-12");
                img.file = file;
                nameOfPictureModify.appendChild(img);

                let reader = new FileReader();
                reader.onload = ( function(aImg) {
                    return function(e) {
                        aImg.src = e.target.result;
                    };
                }(img));
                reader.readAsDataURL(file);

            }
        }
    }

    $("#btn_input_img").hide();

    //allows the display of the image modification form
    jQuery(".add_the_input_picture").click( function(e) {
        let nameOfPicture = $(this).attr("name");

        jQuery(".new_input_files").append("<div class=\"preview\">\n" +
            "    <p class=\"alert alert-warning\">Aucun fichier sélectionné pour le moment," +
            " attention seul les images en .jpg, .jpeg, .png et d'une taille inférieur à 2mo sont autorisés!</p>\n" +
            "  </div><div class=\"custom-file\">" +
            "<input type=\"file\" " +
            "id=\"input_new_file\" " +
            "class=\"input_new_file custom-file-input\" " +
            "name=\""+ nameOfPicture +"\" accept=\".jpg, .jpeg, .png\" >" +
            "<label class=\"custom-file-label\" for=\"input_new_file\" data-browse=\"Choisir\">nouveau fichier</label>" +
            "<button id=\"fileSelect\" class=\"btn btn-warning\"> Valider le fichier </button></div>");

        $("input[type=file]").change(function (e) {
            $(this).next(".custom-file-label").text(e.target.files[0].name);
            $(".preview").hide();
        });
        e.preventDefault();

        //allows the display of modified photos
        jQuery("#fileSelect").click( function () {
            let blockNewInput = document.querySelector(".new_input_files");
            let selectedFile = document.querySelector("#input_new_file");
            let preview = document.querySelector(".preview");

            let nameOfPictureModify = document.querySelector(".img_id_" + nameOfPicture);

            handleFiles(selectedFile, preview, nameOfPictureModify, nameOfPicture, blockNewInput);

            jQuery("#btn_input_img").show();
        });
    });

    //function allowing photos to be saved by the server
    jQuery("#btn_input_img").click( function(e) {
        e.preventDefault();
        let imageToSave = document.querySelectorAll(".obj");
        for (let i = 0; i < imageToSave.length; i++) {
            fileUpload(imageToSave[i], imageToSave[i].file);
        }
    });
});