<?php
$servername="localhost";
$username="root";
$password="";
$dbname="student";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(! $conn)
{
echo 'connection failed';
}
else
{
echo '<html>
<body>
<center>
<form name="myform" method="post">
<table border="2" style="height:70%,width:50%">
<tr><th colspan="2"><h1>STUDENT</h1></th></tr>
<tr><td><h3>NAME</h3></td><td><input type="text" name="NAME"></td></tr>
<tr><td><h3>CLASS</h3></td><td><input type="text" name="CLASS"></td></tr>
<tr><td><h3>AGE</h3></td><td><input type="text" name="AGE"></td></tr>
<tr><td><h3>MARK</h3></td><td><input type="text" name="MARK"></td></tr>
<tr><td colspan="2"align="center"><input type="submit" name="submit"></td></tr>
</table>
</form>
</center>
</body>
</html>';
if(isset($_POST["submit"]))
{
$NAME=$_POST["NAME"];
$CLASS=$_POST["CLASS"];
$AGE=$_POST["AGE"];
$MARK=$_POST["MARK"];
$sql="insert into student values('$NAME','$CLASS',$AGE,$MARK)";
if(mysqli_query($conn,$sql))
{
echo'<script>alert("NEW RECORD IS ADDED");</script>';
}
else
{
echo"error".mysqli_error($conn);
}

$sql1="select * from student";
$result=mysqli_query($conn,$sql1);
if(mysqli_num_rows($result))
{
echo '<br><br><center><table border="2" style="border-collapse:collapse"><tr><th>NAME</th><th>CLASS</th><th>AGE</th><th>MARK</th></tr>';
while($row=mysqli_fetch_assoc($result))
{
echo '<tr><td>'.$row["NAME"].'</td><td>'.$row["CLASS"].'</td><td>'.$row["AGE"].'</td><td>'.$row["MARK"].'</td></tr>';
}
echo '</table></center>';
}
else
{
echo'<script>alert("table is empty")</script>';
}
mysqli_close($conn);
}
}
?>
