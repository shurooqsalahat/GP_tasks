<?php
include ('../connect_DB.php');
include ('../model.php');
if (isset($_POST['form'])){
    $form =$_POST['form'];
}
if (isset($_POST['id'])){
    $id =$_POST['id'];
}
parse_str($form, $output);
$first= $output['first'];
$last= $output['last'];
$email= $output['email'];
$phone= $output['phone'];
$doctor= $output['doctor'];
//echo 'first: '.$first.'  last: '.$last.' email: '.$email.'  phone: '.$phone.' Doctor: '.$doctor;
$sql1 = "UPDATE students SET first='".$first."' WHERE id=".$id;
$result = $db->query($sql1);
$sql2 = "UPDATE students SET last='".$last."' WHERE id=".$id;
$result = $db->query($sql2);
$sql3 = "UPDATE students SET email='".$email."' WHERE id=".$id;
$result = $db->query($sql3);
$sql4 = "UPDATE students SET phone='".$phone."' WHERE id=".$id;
$result = $db->query($sql4);
$sql5 = "UPDATE students SET doctor_id='".$doctor."' WHERE id=".$id;
$result = $db->query($sql5);