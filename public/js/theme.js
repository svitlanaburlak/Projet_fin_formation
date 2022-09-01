const theme = {
    init: function(){

        const isDarkThemeOn = localStorage.getItem("theme-dark")

        // si la clé n'éxiste pas on la crée avec pour valeur par défaut false
        if(isDarkThemeOn === undefined){
            console.log("on a pas trouvvé la valeur");
            localStorage.setItem("theme-dark", "false");
        }

        if(localStorage.getItem("theme-dark") === "true"){
            console.log("switch");
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

        // Si on était en dark-theme
        if(localStorage.getItem("theme-dark") === 'true'){
            // la fonction switchTheme nous fais basculer en light
            // il faut mettre à jour la vaelur de theme-dark dans le localStorage
            localStorage.setItem("theme-dark", false);
        }else{
            // Si on était en theme light
            // On doit mettre a jour la valeur de dark-theme dans le localstorage
            localStorage.setItem("theme-dark", true);
        }
    }
   
}

document.addEventListener("DOMContentLoaded", function(){
    theme.init();
});