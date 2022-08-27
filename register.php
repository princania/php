<?php
session_start();
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "projectAutoCluster";
$connect = mysqli_connect($servername, $username, $pass, $dbname);
mysqli_report(MYSQLI_REPORT_OFF);

if(isset($_POST['register']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    $_SESSION["name"]= $name;
   
    if(!$connect)
    {
        die("Could not connect to the database!");
    }
    $count = (mysqli_fetch_object(mysqli_query($connect, "SELECT COUNT(*) AS count FROM users")))->count;
    $count=$count+1;
    $_SESSION["id"]=$count;
    $sql = "INSERT INTO users (email, password, name, id) VALUES ('$email', '$password', '$name', $count); ";
    
    if(mysqli_query($connect, $sql) )
    {
        header("Location: success.php");
        exit();
    }
    else
    {
        header("Location: failure.php");
        exit(); 
    }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Signin Template · Bootstrap v5.2</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <link href="bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
      button{
        margin-bottom: 10px;
      }
      a{
        color: white;
        text-decoration: none;
      }
      a:hover{
        color: white;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin w-100 m-auto">

  
  <form action="register.php" method="post">
    <img class="mb-4" src="login-icon-3060.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please Register</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingPassword" placeholder="Full Name" name="name">
      <label for="floatingPassword">Full Name</label>
    </div>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Password</label>
    </div>

    
    <button class="w-100 btn btn-lg btn-success" type="submit" name="register">Register</button>
    
  </form>

      <form action="register.php" method="post">
  <button class="w-100 btn btn-lg btn-primary" name="gotologin">Log in</button>
  </form>
  <?php

      if(isset($_POST['gotologin']))
      {
        header("Location: login.php");
        exit();
      }

  ?>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
</main>
</body>
</html>
