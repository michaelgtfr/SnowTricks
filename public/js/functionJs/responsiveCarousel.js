/*created by michaelgtfr
 * the passage of a button to a miniature display of carousel photos,
 * this passage is done in relation to the size of the browser
 */
jQuery(document).ready( function() {
    function screenTest(){
        let size = document.body.clientWidth;

        if(size > 540) {
            //if the display is greater than 540px
            let responsive = document.querySelector("#dropdownMenuButton");
            responsive.remove();

            let drop = document.querySelector(".dropdown-menu");
            drop.setAttribute("class", "balise_responsive");
        } else {
            //if the display is less than 540px
            let responsive = document.querySelector("#dropdownMenuButton");
            if(responsive == null) {
                let dropdown = document.querySelector(".dropdown");
                dropdown.insertAdjacentHTML("afterbegin",
                    "<button class=\"btn btn-warning dropdown-toggle\" " +
                    "type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" " +
                    "aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
                    "                            Images\n" +
                    "                        </button>");
            }
            let drop = document.querySelector(".balise_responsive");
            drop.setAttribute("class", "dropdown-menu");
        }
    }

    let width = document.body.clientWidth;

    //modification if the image exceeds 540px
    if (width > 540) {
        let responsive = document.querySelector("#dropdownMenuButton");
        responsive.remove();

        let drop = document.querySelector(".dropdown-menu");
        drop.setAttribute("class", "balise_responsive");
    }

    //screen modification at width change
    window.addEventListener("resize", screenTest);
});