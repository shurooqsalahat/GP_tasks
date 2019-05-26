

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

 $(document).on('click', '.get-btn', function(){
     var id =$(this).data("id3");
     //alert(id);

//
//
     //window.location = sUrl
    window.location.href = "student-tasks.php?std_id="+id;

 });
