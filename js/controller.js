var myFunction = function () {
    document.getElementById("myDropdown").classList.toggle("show");
}


// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("user-account-dropdown");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

$(document).ready(function(){
    $(".close").click(function(){
        if($(".alert-warning").is(":visible")){
            console.log("error")
            $(".alert-warning").hide();}
        else if($(".alert-success").is(":visible")){
            $(".alert-success").hide();
        }
    });
});



