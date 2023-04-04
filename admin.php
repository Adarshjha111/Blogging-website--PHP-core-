
<?php


session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['username'] != "Adarsh"){
    
  header("location: unauthorized.php");
  exit;
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/public_styling.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Admin </title>
    <link rel="icon" href="images/greyb-fevicon.png">
  </head>
  <body>
    <?php require 'partials/_nav_admin.php' ?>
    Admin - <?php echo $_SESSION['username']?>

    <h1>Keep the community in check!</h1>



    <?php



include 'partials/_dbconnect.php';
$name = $_SESSION['username'];

$sql="SELECT * FROM blog_posts ";


$result = mysqli_query($mysqli,$sql);



while($row = mysqli_fetch_array($result)){

 // print($row["post_title"]);

  $db = mysqli_connect("localhost", "root", "admin", "tests");
  $my_post_title = $row["post_title"];
  //print($my_post_title);

  $image_sql = "SELECT filename FROM image WHERE post_title='$my_post_title'";
  //print_r('c1');
  $image_result = mysqli_query($db,$image_sql);
  //print_r('c2');
  //print($image_result);
  if(mysqli_num_rows($image_result)>0)
    {
        //print_r('c3');
        $data = mysqli_fetch_array($image_result);
              
        $image = $data['filename'];
        if (empty($image)) $image = "default.jpg";
    } 
?>

<div class="blog-container" style = "background-color: #F5FFC6;">


    <p style="color:#3E54AC;font-weight: bold;"><?php echo $row["post_title"];?></p>
    <p style="color:#655DBB;font-weight: 900;"> by <?php echo $row["username"];?> on <?php echo $row["post_date"];?></p>
    <p style="color:#F99417;"><?php echo $row["content"]; ?></p> 
    <img src="./image/<?php echo  $image; ?>"alt="Image" width="300" height="300">
    <P> </p>

    
    <a href="delete.php?post_title=<?php echo $row["post_title"]; ?>">Delete</a>
    <p> </p>
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
