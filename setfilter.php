<?php
session_start();
$_SESSION["fCategory"]=$_POST['fCategory'];
$_SESSION["fSupplier"]=$_POST['fSupplier'];
$_SESSION["fOrderDate"]=$_POST['fOrderDate'];
$_SESSION["fName"]=$_POST['fName'];
$_SESSION["fPayment"]=$_POST['fPayment'];
?>