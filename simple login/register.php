<?php
require_once 'config.php';

function clean($value){
    $value=htmlspecialchars(trim($value));
    return $value;
}

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=clean($_POST['username']);
    $password=password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checksql='SELECT * FROM users WHERE username=?';
    $stmt= $conn->prepare($checksql);
    $stmt->bind_param('s',$username);
    $stmt->execute();

    $result=$stmt->get_result();
    if ($result->num_rows >0){
        echo 'the user name is already exist use another one';
    }
    else{
        $sql='INSERT INTO users  (username, password) VALUE (?,?)';
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('ss',$username, $password);
        if ($stmt->execute()){
            echo 'registration is sucessfull <a href=login.html>login</a>';
        }
        else{
            echo 'error '. $stmt->error();
        }

    }
    $stmt->close();

}
$conn->close();

?>


