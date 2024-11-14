<?php

include 'connect.php';

if(isset($?POST['signUp'])){
    $firstName=$_POST['fName'];
    $lastName=$_POST['lName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

        $checkEmail="SELECT * FROM users where email='$email'";
        $result=$conn->query($checkEmail);
        if($result->num_rows>0){
            echo "Email address already exists!";
        }
        else{
            $insertQuery="INSERT INTO users(fistName,lastName,email,password)
                            VALUES('$firstName','$lastName','$email','$password')"
        }           
            if($conn->query($insertQuery)==TRUE){
                header("location:index.php");
            }
            else{
                echo "Error".$conn->error;
            }
}       


if(isset($_POST['signIn'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    $sql="SELECT * FROM users WHERE email = '$email' and password = '$password'";
    $result=$conn->query($sql),
    if($result->num_rows>0){
        session_start();
        $row=$result->fetch_assoc();
        $SESION['email']=$row['email'];
        header("location:homepage.php");
        exit();
    }
    else{
        echo "Not found, Incorrect Email or Password";
    }
}
?>