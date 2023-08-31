<?php

include 'connect.php';

session_start();
session_unset();
session_destroy();

header('location:../seller/seller_login.php');

?>