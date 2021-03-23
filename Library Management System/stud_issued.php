<?php
  session_start();
  if(!isset($_SESSION['stud_rollno'])){
    header("location:login.php");
  }
  include_once('config.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>Library Management System</title>
  <link rel="icon" type="image/png" href="assets/image/logo2.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    body{
      font-family: "Serif";
    }

    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    th{
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
      color: white;
      background-color: black;
    }

    td{
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href=""><p style="margin-top:-3px;color:white;"><img src="assets/image/logo-book.png" alt="" width="40" height="35">&nbsp;LMS</p></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index_stud.php">Home</a></li>
        <li><a href="stud_book.php">Books</a></li>
        <li class="active"><a href="">Issued Book</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="chnge_psswd.php"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-12 text-left">
      <h1>Issued Books</h1>
      <hr>
    </div>
  </div>
  <br>
  <form class="" action="" method="post">
    <br>
    <div class="row content">
      <div class="col-sm-2 text-left">
      </div>
      <div class="col-sm-8 text-left">
        <input type="hidden" name="bookid" id="bookid">
        <table>
          <tr>
            <th>BookID</th>
            <th>Book Name</th>
            <th>Issue Date</th>
            <th>Return Date</th>
          </tr>
          <?php
              $index = 1;
              $msg = "";
              $query = "SELECT * FROM BookIssue WHERE stud_rollno='".$_SESSION['stud_rollno']."'";
              $result = mysqli_query($con, $query);
              if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  $book = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM Book WHERE book_id = '".$row['book_id']."'"));
                  $msg .= "<tr id='".$index++."'>
                              <td>".$row['book_id']."</td>
                              <td>".$book['book_title']."</td>
                              <td>".date("d/m/Y", strtotime($row['issue_date']))."</td>";
                  if($row['return_date']==NULL){
                      $msg .= "<td><span style='color:red'>Not Returned</span></td></tr>";
                  }
                  else{
                    $msg .= "<td>".date("d/m/Y", strtotime($row['return_date']))."</td></tr>";
                  }
                }
              }
            $msg.="<table>";
            echo $msg;
          ?>
    </div>
    <div class="col-sm-2 text-left">
    </div>
  </div>
</div>
<br><br>

</body>
</html>
