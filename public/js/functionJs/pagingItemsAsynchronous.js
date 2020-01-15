//pagination of blog articles via ajax, request, retrieve and display 5 articles

jQuery(document).ready(function(){
    let number_article_load = 10;

    //removal of the 'more plus' button
    if (number_article_load >= number_items) {
        $(".block_btn_more").hide();
    }
    $(".ancre_bottom").hide();

    $("#btn-more").click(function(e){
        e.preventDefault();
        $.ajax({
            url : '/homepagePagination',
            type : 'POST',
            data : 'numberArticleLoad=' + number_article_load,
            dataType : 'text',
            success : function(content){
                //display of blog articles retrieved
                let newItems = JSON.parse(content);
                number_article_load += 5;
                for (let i = 0; i < newItems.length; i++) {
                    let path_detail_article = "/detail/" + newItems[i].id;
                    let title_article = newItems[i].title;
                    title_article = title_article.substr(0, 8);
                    let path_modify_article = "/profile/modifyArticle?id=" + newItems[i].id;
                    let path_delete_article = "/deleteArticle?id=" + newItems[i].id;
                    let account_user = '';
                    if (role_user === true) {
                        // language=HTML
                        account_user = '<a class="modify_item fa fa-pen-fancy"' +
                            ' href="' + path_modify_article + '">' +
                            '</a> ' +
                            '<a class="delete_item fa fa-trash-alt" ' +
                            ' href="' + path_delete_article + '">' +
                            '</a>';
                    }

                    if(newItems[i].name === null)
                    {
                        newItems[i].name = 'picture_by_default';
                        newItems[i].extension = 'jpg';
                    }

                    // language=HTML
                    jQuery('.items').append('<div class="blockItem card-deck col-lg-3 col-xs-12">' +
                        '<div class="card border-0 shadow">' +
                        '<img class="card-img-top img_item" ' +
                        'src="img/imgPost/' + newItems[i].name +'.'+ newItems[i].extension +'" ' +
                        'alt="'+ newItems[i].description +'" />' +
                        '<div class="card-body col-xs-12 text-center">' +
                        '<a class="title_item col-lg-6" '+
                        'href="'+ path_detail_article +'">' +
                        title_article +
                        '</a>' + account_user + '</div></div></div>');
                }

                //anchor display if there are more than 15 items
                if (number_article_load >= 15) {
                    $(".ancre_bottom").show("slow");
                }

                //removal of the 'more plus' button
                if (number_article_load >= number_items) {
                    $(".block_btn_more").hide();
                }
            },
            error : function(content, status){
                //displays an error message
                jQuery('#title_block').append('<div class = "alert alert-danger"><p>' +
                    status + ': ' + content + '</p></div>');
            },
        })
    });
});