 <?php 
include_once('php/DBConnection.php'); 
session_start(); ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/lss.css">
</head>
    
    
<body>
      
           <section class="agents-grid grid">
    <div class="container">
	<div class="row">
	<div class="col-sm-6"></div>
	 <div class="col-sm-3" dir="rtl"lang="AR">
          <div class="grid-option">
            <form>
              <select class="custom-select" id="teacheName">
                <option >select superVisor </option>
              </select>
            </form>
          </div>
        </div>
		 <div class="col-sm-3" dir="rtl"lang="AR">
          <div class="grid-option">
            <form>
              <select class="custom-select" id="courseName">
                <option >select Student</option>
              </select>
            </form>
          </div>
        </div>
		
		 <div class="col-md-12 mb-3">
                    <div class="form-group">
			
             
                    </div>
                  </div>
                 
                   <div class="col-md-12 mb-3">
                    <div class="form-group" dir="rtl">
                      <textarea id="msg_cont" name="message" class="form-control" name="message" cols="45" rows="6" data-rule="required" data-msg="Please write something for us" placeholder="Write Message"></textarea>
                      <div class="validation"></div>
                    </div>
                  </div>
				    <div class="col-md-12">
                    <button id="sendMsg"  class="btn btn-a">Send</button>
                  </div>
	</div>
    
   </div>
               
               
    </section>
    
    
    <?php
 include 'footer.php' ;
  ?>
  <!--/ Footer End /-->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/popper/popper.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/scrollreveal/scrollreveal.min.js"></script>


  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>
    </body>
    
</html>

<script type="text/javascript">
  var Msg_Arr = new Array();
  function showContent(start) {
    start*=3;
    var end=start+3;
    $("#getMsgStudent").html('');
      for (var i =start;i<end;i++) {
        if(i>=Msg_Arr.length)
          break;
          $("#getMsgStudent").html($("#getMsgStudent").html()+Msg_Arr[i] );

        }
    }

   $(document).ready(function(){
    $.ajax({  
      type: 'POST',  
      url: 'php/show.php', 
      dataType: 'JSON',
      data:{show:"courseName"},
      success: function(response) {

        for (var i = 0; i < response.length; i++) {
          $("#courseName").html($("#courseName").html()+'<option value='+response[i]["id"]+'>'+response[i]["name"]+'</option>' );

        }

      }
    });
    ///////////////////////////////////////

    
    $('#courseName').on('change',function(){
        var courseNameID = $(this).val();
        $("#teacheName").html('');
        $.ajax({  
      type: 'POST',  
      url: 'php/show.php', 
      dataType: 'JSON',
      data:{show:"teacherName",
            SpecID:courseNameID

    },
      success: function(response) {

        for (var i = 0; i < response.length; i++) {
          $("#teacheName").html($("#teacheName").html()+'<option value='+response[i]["id"]+'>'+response[i]["name"]+'</option>' );

        }

      }
    });
        
    });

    
 
    //////////////////////////////////////
    $('#sendMsg').click(function(){
      var teacherName=$("#teacheName").val();
      var msg = $.trim($("#msg_cont").val());

            if(msg != ""){
                $("#teacheName").html('');
        $.ajax({  
      type: 'POST',  
      url: 'php/show.php',
      dataType: 'JSON',
      data:{show:"SendStudentToTeacher",
            teacherID:teacherName,
            msg:msg,
            fromWho:"1"

    },
      success: function(response) {
        swal(':) ', 'done ', "success");

      }
    });

            }
    });




  $.ajax({  
      type: 'POST',  
      url: 'php/show.php',
      dataType: 'JSON',
      data:{show:"getMsgStudent",
    },
      success: function(response) {
        var len=response.length/3;
        
        for (var i = 0; i < len; i++) {
          $("#course_scroll").html($("#course_scroll").html()+'<li class="page-item"><a class="page-link" onclick="showContent('+i+')">'+(i+1)+'</a></li>' );
        }
        $("#course_scroll").html($("#course_scroll").html()+'<li class="page-item next"><a class="page-link" href="#"><span class="ion-ios-arrow-forward"></span></a></li>');


        for (var i = 0; i < response.length; i++) {
          var ID=response[i]["ID"];
          var techer_name=response[i]["techer_name"];
          Msg_Arr[i]='<tr id="'+ID+'"><td class="inbox-small-cells"><input type="checkbox" class="mail-checkbox"></td><td>'+techer_name+'</td><td>?View your Message</td></tr>';
        }
        showContent(0);

      }
    });
    //////////////////////////////////


  });
</script>
<script>
  $(document).ready(function(){
    $("#inbox_active").addClass("active");
  });