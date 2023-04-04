<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>
<?php

    error_reporting(0);

    $msg = "";

    // If upload button is clicked ...
    if (isset($_POST['upload'])) {

        $post_title = $_POST["post_title"];
        $filename = $_FILES["uploadfile"]["name"];
        
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        
        $folder = "./image/" . $filename;


        $db = mysqli_connect("localhost", "root", "admin", "tests");

        ini_set('display_errors',1);
        error_reporting(E_ALL);

        /*** THIS! ***/
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        if (empty($filename)) $filename = "default.jpg";

        // Get all the submitted data from the form
        $sql = "INSERT INTO image (filename,post_title) VALUES ('$filename','$post_title')";

        // Execute query
        mysqli_query($db, $sql);
       
        // move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder)) {
           
            echo "<h3> Image uploaded successfully!</h3>";
        } else {
            echo "<h3> Failed to upload image!</h3>";
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
        
            include 'partials/_dbconnect.php';
            
            $post_title = $_POST["post_title"];
           
            $content = $_POST["content"];
           
            $username = $_SESSION['username'];
            
            $showAlert = false;
                
        
                if($showAlert==FALSE){
                    ini_set('display_errors',1);
                    error_reporting(E_ALL);
            
                    /*** THIS! ***/
                    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            
                $sql = "INSERT INTO  blog_posts ( post_title, content,username) VALUES ('$post_title', '$content','$username')";
                $result = mysqli_query($mysqli, $sql);
        
            }
            
                if ($result){
                    
                    $showAlert = true;
                    header("location: my_blogs.php");
                    exit();
                
                }

        }
            
    }
?>


<?php
    $showAlert = false;
?>

<!doctype html>
<html lang="en">
  <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title>Create</title>
   
        <link rel="icon" href="images/greyb-fevicon.png"> 
    
        <style>
            .tenor-gif-embed{
                display: block;
                margin: 0 auto;
            }
        </style>
    </head>
  <body>
    <?php require 'partials/_nav_loggedin.php' ?>
    
    <?php  
    
        if($showAlert==TRUE){
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Blog is created Successfully!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div> ';
            }
        
    ?>
    
    <div class="container my-4">
     <h1 class="text-center" style="color:#8EA7E9;">Lets Create!</h1>
    
     <script type="text/javascript">

        function IsEmpty() {
            if (document.forms['Form'].post_title.value === "") {
                alert("Please write a Title for your blog!");
                return false;
                }

                if (document.forms['Form'].content.value === "") {
                    alert("Please write content for your blog!");
                    return false;
                }
                    return true;
            }



        </script>
       
        
        </form>
        <form method="POST" action="" enctype="multipart/form-data" name="Form" >
        <div class="form-group">
            <label for="post_title" style="color:#3E54AC;font-weight: bold;">Post Title</label>
            <input type="text" class="form-control" id="post_title" name="post_title" aria-describedby="emailHelp" maxlength="50">
           
            
        </div>
        <div class="form-group">
            <!--
            <label for="content" style="color:#F99417;">Content</label>
        -->
            <!--
            <input type="text" class="form-control" id="content" name="content" maxlength="245">
        -->
            <textarea placeholder="Add Content" class="textarea" name="content" rows="10" cols="114" id="content" maxlength="1500"   required="required"></textarea>


        </div>
            <div class="form-group">
                <input class="form-control" type="file" name="uploadfile" value="" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" onclick="return IsEmpty();" type="submit" name="upload">UPLOAD </button>
            </div>
        </form>
    </div>

    <div class="tenor-gif-embed" data-postid="21758930" data-share-method="host" data-aspect-ratio="1.33333" data-width="10%" ><a ;href="https://tenor.com/view/writing-gif-21758930">Writing GIF</a>from <a href="https://tenor.com/search/writing-gifs">Writing GIFs</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js"></script>

        <div >
        <?php include('footer.html'); ?>

        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
