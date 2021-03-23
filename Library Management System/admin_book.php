<?php
  session_start();
  if(!isset($_SESSION['admin_user'])){
    header('location:login.php');
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
        <li><a href="index_admin.php">Home</a></li>
        <li class="active"><a href="">Books</a></li>
        <li><a href="admin_stud.php">Students</a></li>
        <li><a href="admin_issue.php">Issue Book</a></li>
        <li><a href="admin_return.php">Return Book</a></li>
        <li><a href="admin_issued.php">Issued Book</a></li>
        <li><a href="admin_appr.php">Approvals</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="chnge_psswd.php"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php
  if(isset($_REQUEST['delete'])){
    $bookid = $_REQUEST['bookid'];
    $query = "DELETE FROM Book WHERE book_id='".$bookid."'";
    mysqli_query($con, $query);
    $msg = "<script>alert('Book Record Deleted Successfully!!');</script>";
    echo $msg;
  }
  if(isset($_REQUEST['add'])){
    $title = $_REQUEST['title'];
    $author = $_REQUEST['author'];
    $edition = $_REQUEST['edition'];
    $publisher = $_REQUEST['publisher'];
    $query = "SELECT * FROM Book ORDER BY book_id DESC LIMIT 1";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result)>0){
      $row = mysqli_fetch_array($result);
      $num = (int)substr($row['book_id'],4);
      if($num<9){
        $id = "ISBN00".($num+1);
      }
      elseif($num<99){
        $id = "ISBN0".($num+1);
      }
      else{
        $id = "ISBN".($num+1);
      }
      $query = "INSERT INTO Book VALUES('".$id."', '".$title."', '".$author."', '".$edition."', '".$publisher."', 0)";
      mysqli_query($con, $query);
    }
    else{
      $query = "INSERT INTO Book VALUES('ISBN001', '".$title."', '".$author."', '".$edition."', '".$publisher."', 0)";
      mysqli_query($con, $query);
    }
    echo $bookid;
  }
?>
<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-12 text-left">
      <h1>Books</h1>
      <hr>
    </div>
  </div>
  <br>
  <form class="" action="" method="post">
    <div class="input-append" align="right" style="margin-right:35px;">
      <select size="1" name="select" class="form-select form-select-sm" aria-label=".form-select-sm example">
        <option value="BookID">BookID</option>
        <option value="BookName">Book Name</option>
        <option value="Author">Author</option>
        <option value="Publisher">Publisher</option>
      </select>
      <input type="text" placeholder="search by" id="searchby" name="searchby"/>
      <button class="btn btn-info" name="search">Search</button>
    </div>

    <br>
    <div class="row content">
      <div class="col-sm-2 text-left">
      </div>
      <div class="col-sm-8 text-left">
        <input type="hidden" name="bookid" id="bookid">
        <table>
          <tr>
            <th>BookID</th>
            <th>Title</th>
            <th>Authors</th>
            <th>Edition</th>
            <th>Publisher</th>
            <th></th>
          </tr>
          <?php
            if(isset($_REQUEST['search'])){
              $index = 1;
              $msg = "";
              $value = $_REQUEST['searchby'];
              if($_REQUEST['select']=='BookID'){
                $var = 'book_id';
              }
              elseif($_REQUEST['select']=='BookName'){
                $var = 'book_title';
              }
              elseif($_REQUEST['select']=='Author'){
                $var = 'book_author';
              }
              else{
                $var = 'book_publish';
              }
              $query = "SELECT * FROM Book WHERE $var='".$value."'";
              $result = mysqli_query($con, $query);
              if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  $msg .= "<tr id='".$index++."'>
                              <td class='row-data'>".$row['book_id']."</td>
                              <td class='row-data'>".$row['book_title']."</td>
                              <td class='row-data'>".$row['book_author']."</td>
                              <td class='row-data'>".$row['book_editn']."</td>
                              <td class='row-data'>".$row['book_publish']."</td>
                              <td><button class='btn btn-danger' type='submit' name='delete' onclick='show()'>Delete</button></td>
                            </tr>";
                }

              }
            }
            else{
              $index = 1;
              $msg = "";
              $query = "SELECT * FROM Book";
              $result = mysqli_query($con, $query);
              if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  $msg .= "<tr id='".$index++."'>
                              <td class='row-data'>".$row['book_id']."</td>
                              <td class='row-data'>".$row['book_title']."</td>
                              <td class='row-data'>".$row['book_author']."</td>
                              <td class='row-data'>".$row['book_editn']."</td>
                              <td class='row-data'>".$row['book_publish']."</td>
                              <td><button class='btn btn-danger' type='submit' name='delete' onclick='show()'>Delete</button></td>
                            </tr>";
                }

              }
            }
            $msg.="<table>";
            echo $msg;
          ?>
          <script>
              function show() {
                  var rowId = event.target.parentNode.parentNode.id;

                  var data = document.getElementById(rowId).querySelectorAll(".row-data");
                  var bookid = data[0].innerHTML;
                  document.getElementById('bookid').value = bookid;
              }
          </script>
      </div>
      <div class="col-sm-2 text-left">
      </div>
    </div>
    <hr>
  </form>
  <div class="row content">
    <div class="col-sm-12 text-left">
      <form class="" action="" method="post">
        <div class="form-group row">
          <div class="col-xs-3">
            <label for="ex2">Title</label>
            <input class="form-control" name="title" id="title" type="text">
          </div>
          <div class="col-xs-3">
            <label for="ex2">Authors</label>
            <input class="form-control" name="author" id="author" type="text">
          </div>
          <div class="col-xs-2">
            <label for="ex2">Edition</label>
            <input class="form-control" name="edition" id="edtion" type="text">
          </div>
          <div class="col-xs-3">
            <label for="ex2">Publisher</label>
            <input class="form-control" name="publisher" id="publisher" type="text">
          </div>
          <div class="col-xs-1" style="margin-top:2%;">
            <button class="btn btn-success" type="submit" name="add">Add</button>
          </div>
        </div>
      </form>
      <br><br><br>
    </div>
  </div>

</div>

</body>
</html>
