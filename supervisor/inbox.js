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
function validate_send_msg() {
    var msgTitle = $('#message_subject').val();
    var senderEmail = $('#send-to-emails').val();
    var content = $('#msg-content').val();
    var vaidate = false;

    $(".error").remove();

    if (msgTitle.length < 1) {
        $('#message_subject').after('<div  style="color:red">This field is required</div>');
        vaidate =true;
    }
    if (content.length < 1) {
        $('#message').after('<div style="color:red">This field is required</div>');
        vaidate =true;
    }
    if ( senderEmail == null) {
        $('#send-to-emails').after('<div style="color:red">This field is required</div>');
        vaidate =true;
    }


    if (!vaidate){
        document.getElementById("send_email").submit();
    }

}