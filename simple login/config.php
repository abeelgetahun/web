<?php
$host='localhost';
$dbusername='root';
$passowrd='';
$dbname='user_auth';
$conn=mysqli_connect($host,$dbusername,$passowrd,$dbname);

if (!$conn){    
    die('erro occur on db connection'.mysqli_connect_error());
}
?>