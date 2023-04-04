<?php
  session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
      header("location: login.php");
      exit;
  }

?>
<?php

  $post_id=$_POST['post_id'];

  $post_title=$_REQUEST['post_title'];

  $username = $_SESSION['username'];

  include 'partials/_dbconnect.php';

  ini_set('display_errors',1);
  error_reporting(E_ALL);

  /*** THIS! ***/
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $sql= "SELECT username FROM blog_posts WHERE post_id='$post_id' ";
    $result = mysqli_query($mysqli, $sql);

    while($row = mysqli_fetch_array($result))
    {
      $GLOBALS['$my_post_username'] = $row["username"];
      
    }


?>

<?php

  if(isset($_POST['post_update'])){

    include 'partials/_dbconnect.php';

      ini_set('display_errors',1);
      error_reporting(E_ALL);

      /*** THIS! ***/
      mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


    $post_id=$_POST['post_id'];
    $post_title=$_POST['post_title'];
    $content=$_POST['content'];

    $new_image = $_FILES['uploadfile']['name'];
    $old_image = $_POST['old_uploadfile'];

    if($new_image != '')
    {
      $update_filename = $_FILES["uploadfile"]["name"]; 
      $tempname = $_FILES["uploadfile"]["tmp_name"];
    
    $folder = "./image/" . $update_filename;

      $db = mysqli_connect("localhost", "root", "admin", "tests");
      $image_sql= "UPDATE image SET post_title='$post_title',filename = '$update_filename' WHERE post_id='$post_id'";
      $image_result = mysqli_query($db, $image_sql);

      if (move_uploaded_file($tempname, $folder)) {
        //print_r('d1');
        echo "<h3> Image uploaded successfully!</h3>";
      } else 
      {
            echo "<h3> Failed to upload image!</h3>";
        }

    }
    else{

      $update_filename = $old_image;
      print( $update_filename);
    }

      header('location:my_blogs.php');

    $sql= "UPDATE blog_posts SET post_title='$post_title',content='$content' WHERE post_id='$post_id' ";
    $result = mysqli_query($mysqli, $sql);


  

    if($result)
    {
      $_SESSION['message']="Post Updated Successfully!";
      exit(0);
      
    }
    else
    {
      $_SESSION['message']="Something went wrong!";
      exit();
    }

  }

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Update</title>
   <!--.FEVICON....<link rel="icon" href="images/greyb-fevicon.png">.--> 
   <link rel="icon" href="images/greyb-fevicon.png"> 

   <style>
      body{
        background-color: #F5FFC6;
      }
   </style>

  </head>

  <body>
    <?php require 'partials/_nav_loggedin.php' ?>
    
    

    <div class="container my-4">
     <h1 class="text-center">Update your post</h1>
        <a href="my_blogs.php" class="btn btn-danger float-end" style="margin-bottom:10px;">Back</a>

        <?php


          if(isset($_GET['post_id'])){

            ini_set('display_errors',1);
            error_reporting(E_ALL);
    
            /*** THIS! ***/
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            include 'partials/_dbconnect.php';

            $username = $_SESSION['username'];
           
            $post_id=$_GET['post_id'];



            $sql = "SELECT * FROM blog_posts WHERE post_id = '$post_id'";
            $result = mysqli_query($mysqli, $sql);
            

            if(mysqli_num_rows($result)>0)
            {
             $count = 0;
              while($count<1){
                $row = mysqli_fetch_array($result);

               if($row["username"] != $username)
               {
                
                  header("location: login.php");
                  exit;

               }
               else{

                $db = mysqli_connect("localhost", "root", "admin", "tests");
                 $my_post_title = $row["post_title"];
        
                 $image_sql = "SELECT filename FROM image WHERE post_title='$my_post_title'";
                 $image_result = mysqli_query($db,$image_sql);
                 
                 if(mysqli_num_rows($image_result)>0)
                   {
                       $data = mysqli_fetch_array($image_result);
                             
                       $image = $data['filename'];
                       if (empty($image)) $image = "default.jpg";
                   } 

               }

                    $count++;
                  }
            }
            
          }


        ?>

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


     <form action="/loginsystem/edit_blog.php" method="POST" enctype="multipart/form-data" name = "Form">

      <input type="hidden" name="post_id" value ="<?= $row['post_id']  ?>">     

        <div class="form-group">
            <label for="post_title">Post Title</label>
            <input type="text" class="form-control" id="post_title" maxlength="50" name="post_title" value="<?php echo $row["post_title"];?>" >
            
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <input type="text" class="form-control" maxlength="1500" id="content" name="content" value="<?php echo $row["content"];?>"  >    
            <!--<textarea type="text" class="form-control" id="content" name="content" value="<?php echo $row["content"];?>" cols="40" rows="5"></textarea>  -->
        </div>

        <div class="form-group">
                <label for=>Old Image</label>
                <input type="hidden" name="old_uploadfile" value=<?= $image ?> />
                <img src="./image/<?php echo $image ;?>"alt="Image" width="100 px" height="100 px">
                <input class="form-control" style="margin-top:20px;" type="file" name="uploadfile"  />
        </div>
       
         
        <button type="submit" name="post_update" onclick="return IsEmpty();" style="margin-top:20px;" class="btn btn-primary">Update Post</button>
     </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
