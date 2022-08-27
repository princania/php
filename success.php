<?php

session_start();
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "projectAutoCluster";
$connect = mysqli_connect($servername, $username, $pass, $dbname);
$current_balance = '0';
$id = $_SESSION['id'];
$reset = "DELETE FROM transaction WHERE id = $id";

if (isset($_POST['submit'])) {
    $amount = $_POST['amount'];
    if (!$connect) {
        die("Could not connect to database !");
    }

    $t_no = (mysqli_fetch_object(mysqli_query($connect, "SELECT COUNT(*) AS tno FROM transaction")))->tno;
    $t_no = $t_no + 1;

    $add_value = "INSERT INTO transaction (t_no, t_amount, id) VALUES('$t_no', '$amount', '$id'); ";

    mysqli_query($connect, $add_value);
    $current_balance = (mysqli_fetch_object(mysqli_query($connect, "SELECT SUM(t_amount) AS sum FROM transaction WHERE id='$id';")))->sum;
}

if(isset($_POST['reset'])){
    mysqli_query($connect, $reset);
}

if(isset($_POST['delete'])){
    mysqli_query($connect, $reset);
    $deletee = "DELETE FROM users WHERE id = $id";
    if(mysqli_query($connect, $deletee))
    {
        header("Location: login.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hurray !</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Maze&family=Silkscreen&display=swap" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        nav {
            background-color: #34a853;
            padding: 1vh 2vh;
            color: white;
            font-size: 24px;
            height: 7vh;
            border-radius: 0 0 5px 5px;
            font-family: 'Silkscreen', cursive;
            display: flex;
            justify-content: space-between;
        }

        .main {
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            height: 93vh;
            padding-bottom: 15px;
        }

        .a,
        .b {
            margin: 15px 15px 0 15px;
            border-radius: 10px;
        }

        .a {
            flex-grow: 1;
            text-align: center;
            background-color: #f54b55;
            display: flex;
            flex-direction: column;
            color: #9c1616;
        }

        .b {
            flex-grow: 3;
            text-align: center;
            background-color: #4285f4;
        }

        .more>img {
            width: auto;
            height: 5vh;

        }

        .a1,
        .a2 {
            font-family: 'Rubik Maze', cursive;
            background-color: rgba(255, 255, 255, 0.3);
            margin: 2%;
            border-radius: 5px;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .a1 {

            flex: 1;
            margin-bottom: 0;
        }

        .a2 {

            flex: 3;
        }

        .submit {
            background-color: transparent;
            border: none;
        }

        .submit:hover {
            opacity: 0.8;
        }

        input:focus {
            border: 4px solid #8b464a;
            outline: none;
        }

        .balance {
            background-color: #f7aaae;
            height: 50px;
            margin: 20px 50px;
            border-radius: 10px;
            font-family: 'Silkscreen', cursive;
        }

        .transaction_amount {
            background-color: #f7aaae;
            border-style: none;
            width: 80%;
            height: 50px;
            margin: 50px 0px;
            border-radius: 10px;
            text-align: center;
            font-family: 'Silkscreen', cursive;
            color: #9c1616;
            font-size: 22px;
            margin-bottom: 20px;
        }

        ::placeholder {
            color: #8b464a;
            opacity: 1;
        }

        .b1 {
            margin: 2%;
            background-color: #99b7eb;
            height: 85vh;
            border-radius: 10px;
            overflow: scroll;
            color: #074595;
        }

        table {
            width: 100%;


        }

        th {
            text-align: left;
            font-size: 24px;
            border-bottom: 3px solid #1f5cac;
            border-radius: 5px;
            padding: 10px 0 5px 20px;
            font-family: 'Rubik Maze', cursive;
            color: #1f5cac;
        }

        td {
            text-align: left;
            padding-left: 10px;
        }

        tr:nth-child(even) {
            background-color: #4389ff;
        }

        .more {
            height: auto;
            width: 5vh;
            background-color: transparent;
            border: none;
        }

        .more:hover {
            opacity: 0.8;
        }

        .option {
            position: absolute;
            background-color: #34a853;
            right: 0;
            border-radius: 0 0 5px 5px;
            box-shadow: -5px 10px 5px 5px #051008b8;
            display: none;
        }

        .option.active {
            display: block;
        }

        .option>p {
            margin-top: 10px;
            border-bottom: 2px solid #2b9447;
            padding: 10px 15px 10px 15px;
            font-size: 24px;
            cursor: default;
            font-family: 'Rubik Maze', cursive;
            color: #fff;
            line-height: 1.22;
        }

        .option>p:nth-child(3) {
            border-bottom: none;
        }

        .option>p:nth-child(2),
        .option>p:nth-child(3){
            margin-top: 0;
            transition: 0.5s;
        }

        .option>p:nth-child(2):hover,
        .option>p:nth-child(3):hover {
            background-color: #f54b55;
            color: #fff;
        }

        .option>p>img {
            height: auto;
            width: 24px;
            margin-left: 10px;
            display: inline-block;
            vertical-align: center;
            text-align: right;
        }
        div>p>button{
            background-color: transparent;
            border: none;
            font-size: 24px;
            cursor: default;
            font-family: 'Rubik Maze', cursive;
            color: #fff;
        }
    </style>
</head>

<body>

    <nav>
        <p>Money Manager</p>
        <button class="more" id="switch"><img src="user.png" alt="User" onclick="handle()"></button>
    </nav>
    <form action="success.php" method="post">
    <div class="option" id="optionn">
        <?php echo ("<p>Hello {$_SESSION['name']}</p>");  ?>
        <p><button type="submit" name="reset">Reset Balance</button><img src="reset.png" alt=""></p>
        <p><button type="submit" name="delete">Delete Account</button><img src="delete.png" alt=""></p>
    </div>
    </form>
    <div class="main">

        <div class="a">

            <div class="a1">
                <h1>Current Balance</h1>
                <div class="balance">
                    <?php echo ("<h1>{$current_balance}</h1>"); ?>
                </div>
            </div>

            <div class="a2">
                <h1>Enter Transcation Amount</h1>
                <form action="success.php" method="post" class="transaction_form">
                    <input type="number" name="amount" class="transaction_amount" placeholder="Enter Amount"><br>
                    <button type="submit" name="submit" class="submit"><img src="add.png" alt="ADD"></button>
                </form>
            </div>

        </div>

        <div class="b">
            <div class="b1">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                    <?php
                    $total = (mysqli_fetch_object(mysqli_query($connect, "SELECT COUNT(*) AS total FROM transaction WHERE id=$id")))->total;
                    $rows = mysqli_fetch_all(mysqli_query($connect, "SELECT date, t_amount FROM transaction WHERE id=$id"));
                    foreach (array_reverse($rows) as $row) :
                        echo ("<tr>");
                        foreach ($row as $col) :
                            echo ("<td>{$col}</td>");
                        endforeach;
                        echo ("</tr>");
                    endforeach;
                    ?>
                </table>
            </div>
        </div>

    </div>
    <script>
        function handle() {
            document.getElementById("optionn").classList.toggle("active");
        }
    </script>

</body>

</html>