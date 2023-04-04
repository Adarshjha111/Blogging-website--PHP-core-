

<head>

<style>

  .navbar{
    display: flex;
    position: sticky;
    top: 0;
    
  }

ul {
  position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 0;
}



</style>

<?php 

/*
   $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1); 
   //print($page);
*/
?>

<?php
function active($currect_page){

  print('c1');
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  

  print($currect_page);
  print($url);


  if($currect_page == $url){
      echo 'active'; //class name in css 
  } 
}
?>



</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/loginsystem">GreyB-Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item "  >
        <a class="nav-link" href="/loginsystem/admin.php">Home <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item" >
        <a class="nav-link"  href="/loginsystem/my_blogs.php" >My Blogs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="/loginsystem/create_blog.php">Create Blog</a>
      </li>

      <!--
      <li class="nav-item">
        <a class="nav-link" " href="/loginsystem/add_admin.php">Add Admin</a>
      </li>
        -->

      <!--
      <li class="nav-item">
        <a class="nav-link"  href="/loginsystem/admin.php">Admin-Access</a>
      </li>
     
        -->
      <li class="nav-item">
        <a class="nav-link" href="/loginsystem/logout.php">Logout</a>
      </li>
       
      
    </ul>
    <!--
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
-->
  </div>
</nav>
