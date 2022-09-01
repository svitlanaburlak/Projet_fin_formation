const theme = {
    init: function(){

        const isDarkThemeOn = localStorage.getItem("theme-dark")

        if(isDarkThemeOn === undefined){

            localStorage.setItem("theme-dark", "false");
        }

        if(localStorage.getItem("theme-dark") === "true"){

            document.body.classList.toggle("theme-dark");
            const container = document.querySelector(".container-xl");
            container.classList.toggle("bg-dark");

            const cards = document.querySelectorAll(".card");
        
            for(const card of cards){
                card.classList.toggle("bg-dark");
            }
        }

        const themeBtn = document.querySelector(".theme");
        themeBtn.addEventListener("click", theme.switchTheme);
    },

    switchTheme: function(){

        document.body.classList.toggle("theme-dark");
        const container = document.querySelector(".container-xl");
        container.classList.toggle("bg-dark");

        const cards = document.querySelectorAll(".card");
        
        for(const card of cards){
            card.classList.toggle("bg-dark");
        }

        if(localStorage.getItem("theme-dark") === 'true'){
            localStorage.setItem("theme-dark", false);
        }else{
            localStorage.setItem("theme-dark", true);
        }
    }
   
}

document.addEventListener("DOMContentLoaded", function(){
    theme.init();
});