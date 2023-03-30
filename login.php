<?php 
$servername = "localhost";
$usern = "root";
$pass = "";
$databaseName = "nutrofit";
$conn = mysqli_connect($servername, $usern, $pass,$databaseName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$username = trim($_POST['uname']);
$password = trim($_POST['passw']);

    $sql = "SELECT username, password FROM login WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username; 
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt))
    {
        mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt,$username,$passy);
                    if(mysqli_stmt_fetch($stmt))
                    {                        
                        if($passy==$password)
                        {
                            header("location: after.html");
							
                            
                        }
                    }
            }
?>
