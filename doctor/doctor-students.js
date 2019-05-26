

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
    window.location.href = "student-tasks.php?std_id="+id;

 });
$(document).on('click', '.get-sup-data', function(){
    var id =$(this).data("id");
    alert(id);
    window.location.href = "supervisor-information.php?sup_id="+id;

});
