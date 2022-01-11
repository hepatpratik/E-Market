<?php
session_start();

$con= mysqli_connect('localhost','root','');
mysqli_select_db($con,'shgemarket');
define('D',"/backend_projects/grocerry");
?>