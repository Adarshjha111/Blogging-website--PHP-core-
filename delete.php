<?php
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit;
    }
?>


<?php


    include 'partials/_dbconnect.php';
    $post_id=$_REQUEST['post_id'];
    $username = $_SESSION['username'];


    $sql = "SELECT * FROM blog_posts WHERE post_id = '$post_id'";
                $result = mysqli_query($mysqli, $sql);
                

                if(mysqli_num_rows($result)>0)
                {
                $count = 0;
                while($count<1){
                    $row = mysqli_fetch_array($result);


                if($row["username"] != $username  || $username == "Adarsh")
                {
                    
                    header("location: login.php");
                    exit;

                }
                else{

                    // Attempt delete query execution
                        $sql = "DELETE FROM blog_posts WHERE post_id= '$post_id'";
                        $sql_image = "DELETE FROM image WHERE post_id= '$post_id'"; 
                        $db = mysqli_connect("localhost", "root", "admin", "tests");
                        $image_result = mysqli_query($db,$sql_image);
                        if(mysqli_query($mysqli, $sql)&&mysqli_query($db,$sql_image)){
                            header("location: my_blogs.php"); 
                            //echo "Record deleted successfully.";
                            } 
                            else{
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                }
    
                        // Close connection
                    mysqli_close($link);
                    header("location: my_blogs.php"); 
                        exit;


                }
                }
                $count++;
                    }


?>