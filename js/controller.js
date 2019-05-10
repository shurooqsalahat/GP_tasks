
var myFunction=function () {
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
$(document).ready(function() {

    $(".showdiv").click(function () {
        $(".table").show(2000);
    });

});

var showMsg = function (typeOfMsg,msgTxt) {
    console.log('yyyyy')
    if (typeOfMsg == 'Success') {
        $(".alert-success").show();
        $('#success-text').text(msgTxt);

    } else if (typeOfMsg == 'failed') {
        $(".alert-danger").show();
        $('#failed-text').text(msgTxt);
    }
}