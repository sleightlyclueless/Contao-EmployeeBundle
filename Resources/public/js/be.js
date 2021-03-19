document.addEventListener('DOMContentLoaded', function(event) {
    if (document.getElementById("opt_addIcon_0").checked == true) {
        document.getElementsByClassName("be_location_iconpicker").item(0).classList.remove("hide");
    }
    document.getElementById("opt_addIcon_0").onclick = function(event) {
        document.getElementsByClassName("be_location_iconpicker").item(0).classList.toggle("hide");
    }
});