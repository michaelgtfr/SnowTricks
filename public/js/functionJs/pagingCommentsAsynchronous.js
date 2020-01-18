/*created by michaelgtfr
*retrieving article comments via ajax
*/
jQuery(document).ready( function () {
    let numberCommentLoad = 10;
    if (numberCommentLoad >= numberCommentInTheBdd) {
        $(".more_item").hide();
    }
    $("#btn-more").click(function(e){
        e.preventDefault();
        $.ajax({
            url: "/commentPagination",
            type: "POST",
            data: "numberCommentLoad=" + numberCommentLoad +
                "&id=" + idItem,
            dataType: "text",

            success(codeHtml) {
                let newComment = JSON.parse(codeHtml);
                numberCommentLoad += 10;
                for (let i = 0; i < newComment.length; i++) {
                    //date of comment in requested format
                    let date = new Date(newComment[i].dateCreate["date"]);
                    let options = {year: "numeric", month: "2-digit", day: "2-digit"};
                    date = new Intl.DateTimeFormat(["ban", "id"], options).format(date);

                    // language=HTML
                    jQuery(".block-comments").append("" +
                        "<div class=\"block-comment col-lg-12\">\n"+
                            "<div class=\"row\">" +
                                "<div class=\"col-lg-3\">" +
                                    "<img src=\"/img/imgAvatar/"+ newComment[i].picture +"\" " +
                                    "alt=\"image de l'éditeur\">" +
                                "</div>"+
                                "<div class=\"col-lg-9\">"+
                                    "<div class=\"author-and-date col-lg-12 text-center\">" +
                                        "<p>auteur: "+ newComment[i].name +" le "+ date + "</p>\n" +
                                    "</div>"+
                                    "<div class=\"comment col-lg-12 text-center\">" +
                                        "<p>" + newComment[i].comment + "</p>\n" +
                                    "</div>" +
                                "</div>" +
                            "</div>" +
                        "</div>");

                    if (numberCommentLoad >= numberCommentInTheBdd) {
                        $(".more_item").hide();
                    }
                }
            },
            error(content, status) {
                //displays an error message
                jQuery(".block_form_comment").append("<div class=\"alert alert-danger\"><p>" +
                    status + " : " + content + "</p></div>");
            },
        });
    });
});