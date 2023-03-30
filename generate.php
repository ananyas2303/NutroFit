<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--BOOTSTRAP CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Source+Code+Pro:wght@600&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Audiowide&family=Exo+2:wght@300&family=Roboto+Mono&display=swap"
        rel="stylesheet">
    <!--STYLESHEET-->
    <link rel="stylesheet" type="text/css" href="generate_style.css">
    <title>Custom Plan</title>
</head>

<body>
    <div class="conta">
        <img class="bgn" src="BG7.jpg">
        <div class="logo_text">
            <img class="logo" src="logo_i.png">
            <div class="nf">
                <h1>NutroFit</h1>
            </div>
        </div>
        <div class="content">
            <div class="text">
                <h1>
                    MEAL PLANS FOR YOU
                </h1>
            </div>
            <div class="bigcard">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="card">
                        <h3>Enter your details and we'll generate a meal plan especially curated for you !</h3>
                        <!-- USERNAME-->
                        <div class="user_name">
                            <div class="user_namet">
                                <p>ENTER YOUR USERNAME :</p>
                            </div>
                            <div class="user_namei">
                                <input type="text"
                                    style="background-color:transparent ; color:white; border-color:white; font-family:roboto mono; font-size:23px;padding-left:15px"
                                    placeholder="Enter Username" name="uname" id="uname" required>
                            </div>
                        </div>
                        <!-- AGE-->
                        <div class="user_name">
                            <div class="user_namet">
                                <p>ENTER YOUR AGE :</p>
                            </div>
                            <div class="user_namei">
                                <input type="text"
                                    style="background-color:transparent ; color:white; border-color:white; font-family:roboto mono; font-size:23px; width:165px;padding-left:15px"
                                    placeholder="Enter Age" name="ages" id="ages" required>
                            </div>
                        </div>
                        <!-- GENDER-->
                        <div class="user_name">
                            <div class="user_namet">
                                <p>SELECT GENDER :</p>
                            </div>
                            <div class="user_namei">
                                <div class="form-check form-check-inline">
                                    <input type="radio" style=" padding-left:30px " name="gender" id="gender1"
                                        value="option1" required>
                                    <label for="gender1"
                                        style="font-size:23px; font-family:roboto mono; color:white; padding-left:15px; padding-top:10px">MALE</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" style=" padding-left:30px " name="gender" id="gender2"
                                        value="option2">
                                    <label for="gender2"
                                        style="font-size:23px; font-family:roboto mono; color:white; padding-left:15px; padding-top:10px">FEMALE</label>
                                </div>
                            </div>
                        </div>
                        <!-- HEIGHT-->
                        <div class="user_name">
                            <div class="user_namet">
                                <p>ENTER YOUR HEIGHT (in cms):</p>
                            </div>
                            <div class="user_namei">
                                <input type="text"
                                    style="background-color:transparent ; color:white; border-color:white; font-family:roboto mono; font-size:23px; width:220px;padding-left:15px"
                                    placeholder="Enter Height" name="heights" id="heights" required>
                            </div>
                        </div>
                        <!-- WEIGHT-->
                        <div class="user_name">
                            <div class="user_namet">
                                <p>ENTER YOUR WEIGHT (in kgs) :</p>
                            </div>
                            <div class="user_namei">
                                <input type="text"
                                    style="background-color:transparent ; color:white; border-color:white; font-family:roboto mono; font-size:23px; width:220px;padding-left:15px"
                                    placeholder="Enter Weight" name="weights" id="weights" required>
                            </div>
                        </div>
                        <!--SUBMIT BUTTON-->
                            <div class="login">
                                <input type="submit" name="submit" value="SUBMIT" class="login_btn">
                            </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="gen">
        <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "nutrofit";

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Error: " . mysqli_connect_error());
    }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) 
        {
            $name=$_POST["uname"];
            $user_name=mysqli_query($conn,"SELECT username FROM login WHERE username='$name'");
            if(mysqli_num_rows($user_name)==0)
            {
                echo"<p style='font-size: 25px;font-family: 'audiowide'; text-align: center; color: white;z-index:1000;'>User not found. Click here to <a href='register.html'>Sign Up</a></p>";
            }
            else
            {
                $id=mysqli_query($conn,"SELECT user_id FROM login WHERE username='$name'");
                $iid = mysqli_fetch_all($id);
                $zero=$iid[0][0];
                $exer_details=mysqli_query($conn,"SELECT plan_img FROM exercise_plan");
                $meal_details = mysqli_query($conn, "SELECT mplan_img FROM meal_plan");
                $meal_img = mysqli_fetch_all($meal_details);
                $exer_img=mysqli_fetch_all($exer_details);
                $weight=$_POST["weights"];
                $height=$_POST["heights"];
                $bmi=$weight*10000/($height*$height);
                if($bmi<=18.5)
                {
                    $meal=$meal_img[1];
                    $exercise=$exer_img[2];
                    echo "<div class='IMG'><img src=\"$meal[0]\" style='width: 100%;  border: 1px solid #ccc; position: relative'></div>";
                    echo "<div class='IMG'><img src=\"$exercise[0]\" style='width: 100%; border: 1px solid #ccc; position: relative'></div>";
                    $m_id=mysqli_query($conn,"SELECT meal_id FROM meal_plan WHERE mplan_img='$meal[0]'");
                    $e_id=mysqli_query($conn,"SELECT exercise_id FROM exercise_plan WHERE plan_img='$exercise[0]'");
                    $mm_id =mysqli_fetch_all($m_id);
                    $ee_id = mysqli_fetch_all($e_id);
                    $one=$mm_id[0][0];
                    $two=$ee_id[0][0];
                    print_r($zero);
                    print_r($one);
                    print_r($two);
                }
                elseif($bmi>18.5 and $bmi<24.9)
                {
                    $meal=$meal_img[4];
                    $exercise=$exer_img[1];
                    echo "<div class='IMG'><img src=\"$meal[0]\" style='width: 100%;  border: 1px solid #ccc; position: relative'></div>";
                    echo "<div class='IMG'><img src=\"$exercise[0]\" style='width: 100%; border: 1px solid #ccc; position: relative'></div>";
                }
                elseif($bmi>25)
                {
                    $meal=$meal_img[0];
                    $exercise=$exer_img[3];
                    echo "<div class='IMG'><img src=\"$meal[0]\" style='width: 100%;  border: 1px solid #ccc; position: relative'></div>";
                    echo "<div class='IMG'><img src=\"$exercise[0]\" style='width: 100%; border: 1px solid #ccc; position: relative'></div>";
                }
                $sql_query="INSERT INTO user_plan(user_id,exercise_id,meal_id) values (?,?,?)";
                $stmt=$conn->stmt_init();
                $stmt->prepare($sql_query);

                // create variables to hold the values
                $user_id = $zero;
                $exercise_id = $one;
                $meal_id = $two;

                $stmt->bind_param("iii", $user_id, $exercise_id, $meal_id);
                if ($stmt->execute()) {
                    header("Location: signup-success.html");
                    exit;
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
                //echo "<div class='IMG'><img src=\"$meal_img[0]\" style='width: 100%; max-width: 500px; border: 1px solid #ccc; position: relative'></div>";
            }
        }
?>
</div>



</body>
</html>


