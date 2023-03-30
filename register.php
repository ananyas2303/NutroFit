<?php

if(empty($_POST["fname"])){
    die("First name is required");
}
if(empty($_POST["lname"])){
    die("First name is required");
}
if(strlen($_POST["passw"])<6){
    die("Password must be atleast 6 characters");
}
if ( ! preg_match("/[a-z]/i", $_POST["passw"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["passw"])) {
    die("Password must contain at least one number");
}

$pass_hash=password_hash($_POST["passw"],PASSWORD_DEFAULT);

$mysqli= require __DIR__."/connection.php";

$name=$_POST["uname"];
$user_name=mysqli_query($conn,"SELECT username FROM login where username='$name'");
if(mysqli_num_rows($user_name)==0)
{
    $sql="INSERT INTO login(fname,lname,username,password) VALUES(?,?,?,?)";
    $stmt=$mysqli->stmt_init();
    if(! $stmt->prepare($sql)){
        die("SQL ERROR".$mysqli->error);
    }
    $stmt->bind_param("ssss",$_POST["fname"],$_POST["lname"],$_POST["uname"],$_POST["passw"]);
}
else
{
    echo"Username already exists. Do you wish to <a href='login.html'>Login?</a>";
}

?>