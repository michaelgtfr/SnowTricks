//pagination of blog articles via ajax, request, retrieve and display 5 articles

jQuery(document).ready(function(){
    let numberArticleLoad = 10;

    //removal of the 'more plus' button
    if (numberArticleLoad >= numberItems) {
        $(".block_btn_more").hide();
    }
    $(".ancre_bottom").hide();

    $("#btn-more").click(function(e){
        e.preventDefault();
        $.ajax({
            url : "/homepagePagination",
            type : "POST",
            data : "numberArticleLoad=" + numberArticleLoad,
            dataType : "text",
            success(content) {
                //display of blog articles retrieved
                let newItems = JSON.parse(content);
                numberArticleLoad += 5;
                for (let i = 0; i < newItems.length; i++) {
                    let pathDetailArticle = "/detail/" + newItems[i].id;
                    let titleArticle = newItems[i].title;
                    titleArticle = titleArticle.substr(0, 8);
                    let pathModifyArticle = "/profile/modifyArticle?id=" + newItems[i].id;
                    let pathDeleteArticle = "/deleteArticle?id=" + newItems[i].id;
                    let accountUser = "";
                    if (roleUser === true) {
                        // language=HTML
                        accountUser = "<a class=\"modify_item fa fa-pen-fancy\"" +
                            " href=\"" + pathModifyArticle + "\">" +
                            "</a> " +
                            "<a class=\"delete_item fa fa-trash-alt\" " +
                            " href=\"" + pathDeleteArticle + "\">" +
                            "</a>";
                    }

                    if(newItems[i].name === null)
                    {
                        newItems[i].name = "picture_by_default";
                        newItems[i].extension = "jpg";
                    }

                    // language=HTML
                    jQuery(".items").append("<div class=\"blockItem card-deck col-lg-3 col-xs-12\">" +
                        "<div class=\"card border-0 shadow\">" +
                        "<img class=\"card-img-top img_item\" " +
                        "src=\"img/imgPost/" + newItems[i].name +"."+ newItems[i].extension +"\" " +
                        "alt=\""+ newItems[i].description +"\" />" +
                        "<div class=\"card-body col-xs-12 text-center\">" +
                        "<a class=\"title_item col-lg-6\" "+
                        "href=\""+ pathDetailArticle +"\">" +
                        titleArticle +
                        "</a>" + accountUser + "</div></div></div>");
                }

                //anchor display if there are more than 15 items
                if (numberArticleLoad >= 15) {
                    $(".ancre_bottom").show("slow");
                }

                //removal of the 'more plus' button
                if (numberArticleLoad >= numberItems) {
                    $(".block_btn_more").hide();
                }
            },
            error(content, status) {
                //displays an error message
                jQuery("#title_block").append("<div class=\"alert alert-danger\"><p>" +
                    status + " : " + content + "</p></div>");
            },
        })
    });
});