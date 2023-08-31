<?php

include 'components/connect.php';

session_start();

if(isset($_POST['amount'])){

    $pay_id=$_POST['pay_id'];
    $amount=$_POST['amount'];
    $name=$_POST['name'];
    $payment_status="Success";

    $query="INSERT INTO payment (`amount`,`payment_status`,`pay_id`) VALUES ('$amount','$payment_status','$pay_id')";
    mysqli_query($conn,$query);



}





?>