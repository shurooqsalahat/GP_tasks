<?php
session_start();
include "../connect_DB.php";
include "../model.php";
$result =getReceivedMails($_SESSION['email']);
$nor = $result->num_rows;
if ($nor <=0){
    echo' <li><span class="label label-danger">No Messages</span> </li>';

}
else {
    for ($i = 0; $i < $nor; $i++) {
        $row = $result->fetch_array();


        echo '<li>';
        if ($row['is_read']==0){
            echo '<span class="label label-danger">Unread</span>';
        }

        echo'<b>'.$row['subject'].'</b> <i>( '.$row['from'].' )</i>
                                        <span class="quickMenu"  > 
           <span  class="fas fa-envelope-open-text show-msg-inbox " data-type="inbox" data-id3="'.$row[0].'">'.
            '<i></i></span></span></li>';

    }


}

?>
