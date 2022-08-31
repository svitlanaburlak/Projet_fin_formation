const theme = {
    init: function(){
        const themeBtn = document.querySelector(".theme");
        themeBtn.addEventListener("click", theme.switchTheme);
    },

    switchTheme: function(){

        document.body.classList.toggle("theme-dark");
        const container = document.querySelector(".container-xl");
        container.classList.toggle("bg-dark");

        const cards = document.querySelectorAll(".card");
        console.log(cards);
        for(const card of cards){
            card.classList.toggle("bg-dark");
        }
    }
   
}

document.addEventListener("DOMContentLoaded", function(){
    theme.init();
});