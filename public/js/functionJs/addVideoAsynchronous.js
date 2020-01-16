//modification of the images in the browser and in the database asynchronously
jQuery(document).ready( function () {
    $("#btn_input_link").hide();

    // display the video modification button
    jQuery(".add_the_input_movie").click(function(e) {
        let nameOfMovie = $(this).attr('name');

        jQuery(".new_input_files").append('<div class="preview">\n' +
            '    <p class="alert alert-warning">Aucun lien envoyer pour le moment, ' +
            'attention à envoyer un lien commençant par \'http\' ou \'https\'.</p>\n' +
            '  </div><div class="form-group">' +
            '<label for="input_new_url">Nouveau lien</label>' +
            '<input type="url" ' +
            'id="input_new_url" ' +
            'class="input_new_url form-control" ' +
            'name="'+ nameOfMovie +'"/>' +
            '<button id="fileSelectMovie" class="btn btn-warning"> Valider le lien </button></div>');
        e.preventDefault();

        //modification to the link in the browser
        jQuery("#fileSelectMovie").click( function () {
            let block_input_movie = document.querySelector(".link_id_"+nameOfMovie);
            let urlSelect = document.querySelector("#input_new_url");
            let preview = document.querySelector(".preview");
            let blockInput = document.querySelector(".new_input_files");

            manageLink(block_input_movie, urlSelect, preview, blockInput);
        });
    });

    //retrieving the different modified links
    jQuery("#btn_input_link").click( function(e) {
        e.preventDefault();
        let new_link = document.querySelectorAll(".new_link");
        for(let i = 0; i < new_link.length; i++) {
            linkUpload(new_link[i].name, new_link[i].src);
        }
    });

    //function processing links
    function manageLink(input_movie, url, preview, block_input) {
        while(preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }
        let src = url.value;

        if(src.length === 0) {
            let para = document.createElement('p');
            para.textContent = 'Aucun lien actuellement sélectionné pour le téléchargement';
            para.setAttribute('class', "alert alert-danger");
            preview.appendChild(para);
        } else if (src.startsWith('http') === false) {
            let para = document.createElement('p');
            para.textContent = 'Désolé mais votre lien ne suis pas les critères demandés, ' +
                'veuillez prendre un lien commençant par \'http\'';
            para.setAttribute('class', "alert alert-danger");
            preview.appendChild(para);
        } else {
            while (block_input.firstChild) {
                block_input.removeChild(block_input.firstChild);
            }
            //filter youtube
            src = src.replace(/watch\?v=/g, 'embed/');

            let movie = input_movie.querySelector('iframe');
            $(movie).attr('src', src);
            movie.setAttribute('class', "new_link");

            jQuery('#btn_input_link').show();
        }
    }
    //Function allowing to send it to the server
    function linkUpload(name_link_Modify, src_link_modify) {
        $.ajax({
            url : '/modifiedLinkProcessing',
            type : 'POST',
            data : 'name=' + name_link_Modify +
                '&src=' + src_link_modify,
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
                let message_success = document.querySelector('.new_input_files');
                let para = document.createElement('p');
                para.textContent = response + ' : ' + status;
                para.setAttribute('class', "alert alert-danger");
                message_success.appendChild(para);
                jQuery('#btn_input_link').hide();
                setTimeout( function () {
                    message_success.removeChild(message_success.firstChild)
                }, 5000);
            },
        });
    }
});