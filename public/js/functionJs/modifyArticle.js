jQuery(document).ready( function () {
    //allows modification of escaped elements in raw text
    const variableOfTableau = {
        '&#39;': "'",
    };

    let contentItem = document.querySelector('#modify_article_form_content');
    let contentChapo = document.querySelector('#modify_article_form_chapo');
    let contentTitle = document.querySelector('#modify_article_form_title');

    for (let escape in variableOfTableau) {
        contentItem.value = contentItem.value.replace(escape, variableOfTableau[escape]);
        contentChapo.value = contentChapo.value.replace(escape, variableOfTableau[escape]);
        contentTitle.value = contentTitle.value.replace(escape, variableOfTableau[escape]);
    }
});