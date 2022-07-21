<?php 
    session_start();
    if (!isset($_SESSION['sessionid'])) {
        echo "<script>alert('Session is not available Please login');</script>";
        echo "<script> window.location.replace('login.php')</script>";
    }
    include_once("dbconnect.php");
    if (isset($_GET['subject_id'])) {
        $subject_id = $_GET['subject_id'];
        $sqlproduct = "SELECT * FROM tbl_subjects WHERE subject_id = '$subject_id'";
        $stmt = $conn->prepare($sqlproduct);
        $stmt->execute();
        $number_of_result = $stmt->rowCount();
        if ($number_of_result > 0) {
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $rows = $stmt->fetchAll();
        } else {
            echo "<script>alert('Subject not found.');</script>";
            echo "<script> window.location.replace('index.php')</script>";
        }
    } else {
        echo "<script>alert('Page Error.');</script>";
        echo "<script> window.location.replace('index.php')</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com.ajax.libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="../js/menu.js" defer></script>
        <link rel="stylesheet" href="../css/style.css">
        <title>MyTutor</title>
        
        <script>
            function sideMenu(){
                var x = document.getElementById("idsidebar");
                if(x.className.indexOf("w3-show") == -1){
                    x.className += " w3-show";
                }else{
                    x.className = x.className.replace(" w3-show", "");
                }
            }
        </script>
</head>

<body> 
            <div class="w3-bar w3-cyan">
                <a class="w3-bar-item w3-button w3-hide-small" href="index.php">Courses</a>
                <a class="w3-bar-item w3-button w3-hide-small" href="tutor.php">Tutors</a>
                <a class="w3-bar-item w3-button w3-hide-small" href="#">Subscription</a>
                <a class="w3-bar-item w3-button w3-hide-small" href="#">Profile</a>
                <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="sideMenu()">&#9776</a>
            </div>    
                
            <div id="idsidebar" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium w3-cyan">
                <a class="w3-bar-item w3-button " href="index.php">Courses</a>
                <a class="w3-bar-item w3-button " href="tutor.php">Tutors</a>
                <a class="w3-bar-item w3-button " href="#">Subscription</a>
                <a class="w3-bar-item w3-button " href="#">Profile</a>
            </div>

            <div class="w3-container w3-cyan">
                <h3>My Tutor</h3>
            </div>
        </div>
    <div class="w3-container w3-center">
        <?php
            foreach($rows as $subjects) {
                $subject_id = $subjects['subject_id'];
                $subject_name = $subjects['subject_name'];
                $subject_description = $subjects['subject_description'];
                $subject_price = number_format((float)$subjects['subject_price'], 2, '.', '');
                $tutor_id = $subjects['tutor_id'];
                $subject_sessions = $subjects['subject_sessions'];
                $subject_rating = $subjects['subject_rating'];
                echo "<div class='w3-card-4 w3-round' style='margin:4px'><header class='w3-container w3-cyan'><h5><b>$subject_name</b></h5></header>";
                echo "<a href='' style='text-decoration: none;'> <img class='w3-image w3-center' src=../../assets/courses/$subject_id.png" 
                    . " style='width:25%;height:200px'></a><hr>";
                echo "<div class='w3-container'>
                        <h4>
                        <p><br><b>Name of The Subject</b>: $subject_name<br><p>
                        <p><b>Subject Description</b>: $subject_description<br><p>
                        <p><b>Subject Price</b>: RM $subject_price<br><p>
                        <p><b>Subject Session</b>: $subject_sessions<br><p>
                        <p><b>Subject Rating</b>: $subject_rating<br><p>
                        </h4><br>
                    </div>";
            }
        ?>
    </div>
    <footer class="w3-footer w3-center w3-cyan w3-bottom">
        <p>copyright MyTutor</p>
    </footer>    
</body>
</html>