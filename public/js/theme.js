const theme = {
    init: function(){

        const isDarkThemeOn = localStorage.getItem("theme-dark")

        if(isDarkThemeOn === undefined){

            localStorage.setItem("theme-dark", "false");
        }

        if(localStorage.getItem("theme-dark") === "true"){

            document.body.classList.toggle("theme-dark");

            const container = document.querySelector(".container-xl");
            if(container != undefined)
            {
                container.classList.toggle("bg-dark");
            }
            
            const cards = document.querySelectorAll(".card");
            if(cards != undefined) 
            {
                for(const card of cards){
                card.classList.toggle("bg-dark");
                }
            }

            const table = document.querySelector(".table");
            if(table != undefined)
            {
                table.classList.toggle("theme-dark");
            }

            const inputs = document.querySelectorAll("input");
            if(inputs != undefined) 
            {
                for(const input of inputs){
                    input.classList.toggle("bg-dark");
                    input.classList.toggle("text-warning");
                }
            }

            const textareas = document.querySelectorAll("textarea");
            if(textareas != undefined) 
            {
                for(const textarea of textareas){
                    textarea.classList.toggle("bg-dark");
                    textarea.classList.toggle("text-warning");
                }
            }

            const selects = document.querySelectorAll("select");
            if(selects != undefined) 
            {
                for(const select of selects){
                    select.classList.toggle("bg-dark");
                    select.classList.toggle("text-warning");
                }
            }
        }

        const themeBtn = document.querySelector(".theme");
        themeBtn.addEventListener("click", theme.switchTheme);
    },

    switchTheme: function(){

        document.body.classList.toggle("theme-dark");
        const container = document.querySelector(".container-xl");
        if(container != undefined)
        {
            container.classList.toggle("bg-dark");
        }

        const cards = document.querySelectorAll(".card");
        
        if(cards != undefined) 
        {
            for(const card of cards){
                card.classList.toggle("bg-dark");
            }
        }

        const table = document.querySelector(".table");
        if(table != undefined)
        {
            table.classList.toggle("theme-dark");
        }

        const inputs = document.querySelectorAll("input");
        if(inputs != undefined) 
        {
            for(const input of inputs){
                input.classList.toggle("bg-dark");
                input.classList.toggle("text-warning");
            }
        }

        const textareas = document.querySelectorAll("textarea");
        if(textareas != undefined) 
        {
            for(const textarea of textareas){
                textarea.classList.toggle("bg-dark");
                textarea.classList.toggle("text-warning");
            }
        }

        const selects = document.querySelectorAll("select");
        if(selects != undefined) 
        {
            for(const select of selects){
                select.classList.toggle("bg-dark");
                select.classList.toggle("text-warning");
            }
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