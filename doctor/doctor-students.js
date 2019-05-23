

$(document).ready(function(){
    function fetch_data()
    {
        $.ajax({
            url:"live_select.php",
            method:"POST",
            success:function(data){
                $('#live_data').html(data);
            }
        });
    }

    fetch_data();



});


function redirectTo(sUrl) {
    window.location = sUrl
}