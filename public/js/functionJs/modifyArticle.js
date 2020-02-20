jQuery(document).ready( function () {
    //allows modification of escaped elements in raw text
    const variableOfTableau = {
        '&#39;' : "'",
    };

    let contentItem = document.querySelector("#modify_article_form_content");
    let contentChapo = document.querySelector("#modify_article_form_chapo");
    let contentTitle = document.querySelector("#modify_article_form_title");

    for (let escape in variableOfTableau) {
        let newEscape = new RegExp(escape, "g");
        contentItem.value = contentItem.value.replace(newEscape, variableOfTableau[escape]);
        contentChapo.value = contentChapo.value.replace(newEscape, variableOfTableau[escape]);
        contentTitle.value = contentTitle.value.replace(newEscape, variableOfTableau[escape]);
    }
});