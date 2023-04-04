
<?php
  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
      header("location: login.php");
      exit;
  }

?>

<!doctype html>
<html lang="en">
  <head>

  <style>

    .blog-container{
        margin-top: 20px;
        padding-bottom: 15px;
        
        margin-left: 100px;
        margin-right: 100px;
      }

      .my_button_three {
        display: inline-block;
        width: 110px;
        height: 25px;
        background: #4E9CAF;
        padding: 10px 15px;
        text-align: center;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        line-height: 25px;
        padding-bottom: 30px;
        margin-left: 10px;
      }

      .top_part{
        margin-left: 100px;
        padding-bottom: 30px;
      }

      td {
        padding: 0 15px;
      }
    .top_div{
      text-align:center;
      padding-bottom: 30px;
    }
    .second_div{
      text-align:center;
    }

  </style>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--

    <link rel="stylesheet" href="css/public_styling.css">

    -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Welcome </title>
    <link rel="icon" href="images/greyb-fevicon.png">
  </head>
  <body>
  <?php require 'partials/_nav_loggedin.php' ?>
  <div class="top_part">

  
  <h4 style="margin-left:1050px;"> Welcome - <?php echo $_SESSION['username']?></h4>

    <h1 style="color: lightcoral;">Blogs of your choice!</h1>


  </div>

  <div class="top_div">

      <h1>The Best Blogs On Internet!</h1>
      <h4>Be the part of community and enjoy! </h4>
      
      <a class="my_button_three" href="create_blog.php">Create Blog</a>
  </div>

  <div class="second_div">
    <h3>See what community has Shared!</h3>

  </div>
    
  
<?php

    $name = $_SESSION['username'];

    if($name == "Adarsh")
    {
      header("location: admin.php");
    }

    include 'partials/_dbconnect.php';


    $sql="SELECT * FROM blog_posts WHERE 1";

    $result = mysqli_query($mysqli,$sql);

    while($row = mysqli_fetch_array($result)){
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

?>



<div class="blog-container" >

  <table cellspacing="10">
      <tr>
        <td>
  <img src="./image/<?php echo $image ;?>"alt="Image" width="150" height="150">
  <p> </p>
    </td>

    <td>

  <h3 style="color:#3E54AC;font-weight: bold;"><?php echo $row["post_title"];?></h3>
    
    
      <p style="color:#655DBB;font-weight: 900;"> by <?php echo $row["username"];?> on <?php echo $row["post_date"];?></p>
      <a class="my_button_three"  href="one_blog_view.php?post_id=<?php echo $row["post_id"]; ?>">View Blog</a>

    </td>
    </tr>
    </table>
</div>

  <?php } ?>

    
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
