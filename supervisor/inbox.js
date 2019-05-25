var openMsg = function (msgTitle,senderEmail,content,senderName) {
    $('#send_email').css('display', 'none');
    $('#opened-msg').css('display', 'unset');
    $('#opened-msg').find('#msg-title').text(msgTitle);
    $('#opened-msg').find('#sender-email').text(senderEmail);
    $('#opened-msg').find('#sender-name').text(senderName);
    $('#opened-msg').find('#msg-content').text(content);
};

var showNewMsgForm=function () {
    $('#send_email').css('display', 'unset');
    $('#opened-msg').css('display', 'none');

 /*   var selectBox = document.getElementById('selectpicker');

    for(var i = 0, l = emailsArray.length; i < l; i++){
        var option = emailsArray[i];
        selectBox.options.add( new Option(option, option) );
    }*/
/*    $('.selectpicker').selectpicker();
    $('.selectpicker').selectpicker('val', ['Mustard','Relish']);*/
};

var openSentMsg = function (msgTitle,reciverEmail,content,reciverName) {
    $('#sent-opened-msg').css('display', 'unset');
    $('#sent-opened-msg').find('#msg-title').text(msgTitle);
    $('#sent-opened-msg').find('#reciver-email').text(reciverEmail);
    $('#sent-opened-msg').find('#reciver-name').text(reciverName);
    $('#sent-opened-msg').find('#msg-content').text(content);
};
$(document).ready(function(){


    $(document).on('click', '.show-msg-inbox', function(){
        var id = $(this).data("id3");
        var type = $(this).data("type");
         console.log(id);
          console.log(type);

            $.ajax({
                url:"live_show_msg.php",
                method:"POST",
                data:{id:id, type:type},
                dataType:"text",
                success:function(data){
                    $('#opened-msg').html(data);
                    fetch_data();
                }
            });


    });

    $(document).on('click', '.show-msg-sent', function(){
        var id = $(this).data("id3");

        console.log('innn')

        $.ajax({
            url:"live_show_sent_msg.php",
            method:"POST",
            data:{id:id},
            dataType:"text",
            success:function(data){
                $('#sent-opened-msg').html(data);
            }
        });


    });

    function fetch_data()
    {
        console.log('in fetch');
        $.ajax({
            url:"live_inbox.php",
            method:"POST",
            success:function(data){
                $('#live_inbox_data').html(data);
            }
        });
        $.ajax({
            url:"live_sent.php",
            method:"POST",
            success:function(data){
                $('#live_sent_data').html(data);
            }
        });

    }

    fetch_data();


});
function validate_send_msg() {
    var msgTitle = $('#message_subject').val();
    var senderEmail = $('#send-to-emails').val();
    var content = $('#message').val();
    var vaidate = false;

    $(".error").remove();

    if (msgTitle.length < 1) {
        $('#message_subject').after('<div class="error" style="color:red">This field is required</div>');
        vaidate =true;
    }
    if (content.length < 1) {
        $('#message').after('<div class="error" style="color:red">This field is required</div>');
        vaidate =true;
    }
    if ( senderEmail == null) {
        $('#send-to-emails').after('<div class="error" style="color:red">This field is required</div>');
        //vaidate =true;
    }

    if (!vaidate){
      document.getElementById("send_email").submit();
    }

}