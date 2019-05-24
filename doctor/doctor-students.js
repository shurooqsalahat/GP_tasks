

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
    var id =$('.get-btn').data("id3");
    //window.location = sUrl
    window.location.href = sUrl+"?std_id="+id;


}