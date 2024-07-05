const tabButtonDelete = document.getElementsByClassName("deleteCastingInput");
const boutonAddNewLine = document.getElementById("buttonAddNewLine");
const characterBox = document.getElementById("gridContainer");

const tabInputCasting = document.getElementsByClassName("inputActorRole");
const inputCastingClone = tabInputCasting[1].cloneNode(true); //on prends le deuxieme car le titre appartient aussi a la classe

console.log(tabButtonDelete)

function updateEventListener() {

    for (let index = 0; index < tabButtonDelete.length; index++) {
        const element = tabButtonDelete[index];
        element.addEventListener("click",function(){
            this.parentNode.remove();
        })
    }
}


updateEventListener();

boutonAddNewLine.addEventListener("click",function () {
    insertNode=inputCastingClone.cloneNode(true);
    characterBox.appendChild(insertNode);
    updateEventListener();
}
)