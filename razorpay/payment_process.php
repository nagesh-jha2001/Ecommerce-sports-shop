<?php
session_start();

$dlscno=$_SESSION['dlscno'];

include('db.php');
if(isset($_POST['amt']) && isset($_POST['name'])){
    $amt=$_POST['amt'];
    $name=$_POST['name'];
    $payment_status="pending";
    $added_on=date('Y-m-d h:i:s');
    $dlscno=$_SESSION['dlscno'];
    $user_id=$_SESSION['user_id'];
    mysqli_query($con,"insert into payment(user_id,name,amount,payment_status,dlscno,added_on) values('$user_id','$name','$amt','$payment_status',$dlscno,'$added_on')");
    $_SESSION['OID']=mysqli_insert_id($con);
}


if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
    $payment_id=$_POST['payment_id'];
    mysqli_query($con,"update payment set payment_status='complete',payment_id='$payment_id' where id='".$_SESSION['OID']."'");
    mysqli_query($con,"update orders set payment_status='completed' where id='".$_SESSION['dlscno']."'");

}
?>