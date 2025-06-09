<?php
require_once 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['username'];
    $password=$_POST["password"];

    $sql='SELECT * FROM users WHERE username=?';
    $stmt=$conn->prepare($sql);
    $stmt->bind_param('s',$username);
    $stmt->execute();
    $restul=$stmt->get_result();    

    if ($restul->num_rows>0){
        $user=$restul->fetch_assoc();
        if (password_verify($password, $user['password'])){
            $_SESSION['username']=$username;
            header('Location:  welcome.php');
            exit;
        }
        else{
            echo 'password not match';
        }
    }
    else{
        echo 'user doenst exist';
    }
    $stmt->close();
}
$conn->close();

?>




