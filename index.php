<?php
    $isSubmitted = false;
    $isError = false;
    if(isset($_POST["name"])) {
        $server = "localhost";
        $username = "root";
        $password = "";
        $con = mysqli_connect($server, $username, $password);
        if(!$con) {
            die("Database connection failed -> " . mysqli_connect_error());
        }
        $name = $_POST["name"];
        $age = $_POST["age"];
        $uid = $_POST["uid"];
        $section = $_POST["section"];
        $branch = $_POST["branch"];
        $info = $_POST["info"];
        $query = "INSERT INTO `debar`.`debar_list` (`name`, `age`, `uid`, `section`, `branch`, `detail`, `date`) VALUES 
        ('$name', '$age', '$uid', '$section', '$branch', '$info', current_timestamp());";
        // echo $query;
        if(empty($name) or empty($age) or empty($uid) or empty($section) or empty($branch)) {
            $isError = true;
        }
        else if($con->query($query) == true) {
            // echo "Data has successfully been inserted into the Debar database!";
            $isSubmitted = true;
            $isError = false;
        }
        else {
            // echo "ERROR: $query <br>$con->error";
            $isError = true;
        }
        $con->close();
    }
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP NEWBiE</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+P+One&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <img class="bg" src="sekiro2.jpg" alt="Sekiro Background">
        <div class="container">
            <h1>Did you just breathe? Well, guess who is getting debarred now. =)</h1>
            <p>Kindly enter your details if you want to get placed (ahem ahem)</p>
            <?php
            if($isSubmitted) {
                echo "<p class='submitMessage'>You'll be debarred by tomorrow morning. 
                Thank you for making our day! =)</p>";
            }
            else if ($isError) {
                echo "<p class='submitMessageError'>Something went wrong. Check if you have filled
                the details correctly.</p>";
            }
            ?>
            <form action="index.php" method="post">
                <input type="text" name="name" id="name" placeholder="Enter your name...">
                <input type="text" name="age" id="age" placeholder="Enter your age...">
                <input type="text" name="uid" id="uid" placeholder="Enter your uid...">
                <input type="text" name="section" id="section" placeholder="Enter your section...">
                <input type="text" name="branch" id="branch" placeholder="Enter your branch...">
                <textarea name="info" id="info" cols="30" rows="10" placeholder="What's on your mind..."></textarea>
                <button class="btn">Submit</button>
            </form>
        </div>
        <script src="index.js"></script>
    </body>
    </html>