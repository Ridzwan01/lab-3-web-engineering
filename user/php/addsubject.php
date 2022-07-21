<?php 

    if(isset($_POST['submit'])){
            
        include_once("dbconnect.php");

        $name = $_POST['name'];
        $description = ['description'];
        $price = $_POST['price'];
        $tutor = $_POST['tutor'];
        $sessions = $_POST['sessions'];
        $rating = $_POST['rating'];

        $sqlregister = "INSERT INTO `tbl_subjects`(`subject_name`, `subject_description`, `subject_price`, `tutor_id`, `subject_sessions`, `subject_rating`) 
                        VALUES ('$name','$description','$price','$tutor','$sessions','$rating')";
        
        try {
            $conn->exec($sqlregister);
            if (file_exists($_FILES["image"]["tmp_name"]) || is_uploaded_file($_FILES["image"]["tmp_name"])) {
                $last_id = $conn->lastInsertId();
                uploadImage($last_id);
                echo "<script>alert('Success')</script>";
                echo "<script>window.location.replace('index.php')</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Failed')</script>";
            echo "<script>window.location.replace('addsubject.php')</script>";
        }
    }

    function uploadImage($filename)
    {
        $target_dir = "../assets/courses/";
        $target_file = $target_dir . $filename . ".png";
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="../js/image.js"></script>
    
    <title>Add Subject</title>
</head>

<body>
    <header class="w3-center w3-header w3-cyan w3-padding-32">
        <h3><b>Add Subject</b></h3>
    </header>
    
    <div style="display: flex; justify-content:center">

        <div>
            <form class="w3-card w3-padding" action="addsubject.php" method="post" enctype="multipart/form-data">
            <div class="w3-container w3-cyan">
                <h3>Add Subject</h3>
            </div>
            <br>
            <div class="w3-container w3-center">
                <input type="file" name="image" id="imageId" onchange="loadFile(event)" accept="image/*" required>
                <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
                <p><img id="output" width="200" /></p>
            </div>

                <p>
                    <label><b>Subject Name</b></label>
                    <input class="w3-input w3-border w3-round" type="text" name="name" id="idname" required>
                </p>

                <p>
                    <label><b>Subject Description</b></label>
                    <textarea class="w3-input w3-border w3-round" type="text" name="description" rows="4" width="100%" required></textarea>
                </p>

                <p>
                    <label><b>Subject Price</b></label>
                    <input class="w3-input w3-border w3-round" type="text" name="price" id="idprice" required>
                </p>
                
                <p>
                    <label><b>Tutor Id</b></label>
                    <input class="w3-input w3-border w3-round" type="text" name="tutor" id="idtutor" required>
                </p>
                
                <p>
                    <label><b>Subject Session</b></label>
                    <input class="w3-input w3-border w3-round" type="text" name="session" id="idsession" required>
                </p>

                <p>
                    <label><b>Subject Rating</b></label>
                    <input class="w3-input w3-border w3-round" type="text" name="rating" id="idrating" required>
                </p>

                <p>
                    <input class=" w3-round" class="w3-round" type="submit" name="submit"><br><br><br>
                </p>
            </form>
        </div>
        
    </div>

    <footer class="w3-footer w3-center w3-cyan w3-bottom">
        <p>copyright MyTutor</p>
    </footer>    
</body>
</html>