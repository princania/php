<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oops!</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            font-family: cursive;
        }
        div{
            display: grid;
            place-items: center;
            height: 100vh;
            
        }
        h1{
            font-family: cursive;

        }
        button{
        padding: 20px ;
        font-size: large;
        margin-bottom: 10px;
        border-radius: 10px;
        background-color: #198754;
        border: none;
        color: white;
        width: 266px;
      }
      button:hover{
        opacity: 80%;
      }
    </style>
    
</head>

<body>
    <center>
    <div>
        <h1>Soory! Something <span style="color: red;">went wrong</span><br>Try again or register a <span style="color: #198754;">New Account</span> </h1>
        <form action="failure.php" method="post">
  <button style="background-color: #0d6efd;" name="gotologin">Log in</button>
  </form>
  <?php

      if(isset($_POST['gotologin']))
      {
        header("Location: login.php");
        exit();
      }

  ?>
        <form action="failure.php" method="POST">
    <button  name="gotoregister">Create Account</button>
    </form>
    <?php
      if(isset($_POST['gotoregister']))
      {
        header("Location: register.php");
        exit();
      }
    ?>
    </div>
    </center>
</body>

</html>