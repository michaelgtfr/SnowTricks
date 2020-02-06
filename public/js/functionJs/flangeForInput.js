//allows to display the number of characters authorized for an input field

jQuery(document).ready( function () {
    function handleInput(e) {
        let logTitle = document.querySelector('.log_'+e.target.id);

        logTitle.textContent = 'La valeur du champ est de '+ e.target.value.length +' caractères de long' +
            ' sur '+ e.target.maxLength +' caractères maximum autorisés';
        logTitle.style.color = '#000000';
        if (e.target.value.length === e.target.maxLength) {
            logTitle.textContent = 'vous avez atteint le maximum de caractères autorisé';
            logTitle.style.color = '#f00'
        }
    }
    let inputTitle = document.querySelector ('#create_article_form_title');
    inputTitle.oninput = handleInput;

    let inputChapo = document.querySelector('#create_article_form_chapo');
    inputChapo.oninput = handleInput;
});

