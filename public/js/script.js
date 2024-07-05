const openBurgerMenu = document.getElementById("openBurgerMenu");
const closeBurgerMenu = document.getElementById("closeBurgerMenu");

const nav = document.getElementById("menu");
const header = document.getElementById("header");

openBurgerMenu.addEventListener("click",()=> {
    openBurgerMenu.classList.add("hide");
    closeBurgerMenu.classList.remove("hide");
    header.classList.add("deroule");
});

closeBurgerMenu.addEventListener("click",()=> {
    openBurgerMenu.classList.remove("hide");
    closeBurgerMenu.classList.add("hide");
    header.classList.remove("deroule");
})