/*created by michaelgtfr
*retrieving article comments via ajax
*/
jQuery(document).ready( function () {
    let number_comment_load = 10;
    if (number_comment_load >= number_comment_in_the_bdd) {
        $(".more_item").hide();
    }
    $("#btn-more").click(function(e){
        e.preventDefault();
        $.ajax({
            url: '/commentPagination',
            type: 'POST',
            data: 'numberCommentLoad=' + number_comment_load +
                '&id=' + id_item,
            dataType: 'text',

            success : function(code_html) {
                let newComment = JSON.parse(code_html);
                console.log(newComment);
                number_comment_load += 10;
                for (let i = 0; i < newComment.length; i++) {
                    //date of comment in requested format
                    let date = new Date(newComment[i].dateCreate['date']);
                    let options = {year: 'numeric', month: '2-digit', day: '2-digit'};
                    date = new Intl.DateTimeFormat(['ban', 'id'], options).format(date);

                    // language=HTML
                    jQuery('.block-comments').append('' +
                        '<div class="block-comment col-lg-12">\n'+
                            '<div class="row">' +
                                '<div class="col-lg-3">' +
                                    '<img src="/img/imgAvatar/'+ newComment[i].picture +'" alt="image de l\'éditeur">' +
                                '</div>'+
                                '<div class="col-lg-9">'+
                                    '<div class="author-and-date col-lg-12 text-center">' +
                                        '<p>auteur: '+ newComment[i].name +' le '+ date + '</p>\n' +
                                    '</div>'+
                                    '<div class="comment col-lg-12 text-center">'+
                                        '<p>'+ newComment[i].comment +'</p>\n' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>');

                    if (number_comment_load >= number_comment_in_the_bdd) {
                        $(".more_item").hide();
                    }
                }
            },
            error : function(content, status){
                //displays an error message
                jQuery('.block_form_comment').append('<div class = "alert alert-danger"><p>' +
                    status + ': ' + content + '</p></div>');
            },
        })
    });
});