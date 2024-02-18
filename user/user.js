let textBio = document.querySelector(".textBio");
let bio = document.querySelector(".bio");
let userDec = false;
function userBio() {
    if (bio.value.length > 120) {
        textBio.innerHTML = "Character can not be more than 120 characters!";
    } else {
        textBio.innerHTML = "";
       userDec = true;
    }
}
