<html>
    <head>
        <title>exc11</title>
	</head>
		<style>
        body
        {
            background-color:#DAF7A6;
            color:rgb(red,green, blue);
        }
        
        table
        {
		
        background-color:#89CFF0;
        margin-left: auto;
        margin-right: auto;
        margin-top:1em;
        padding:1em;

        }
		</style>
    <body>
		<br><br>
        <center>
        <form name="myform" method="post">
		<h2><u><i>REGISTRATION FORM </i></u></h2>
		<br>
            <table height="65%" width="30%">
                
				<tr>
					<td>
					<h3>Name</h3>
					</td>
						<td>
						<input type="text" name="name" required>
						</td>
				</tr>
                <tr>
					<td>
					<h3>Password</H3>
					</td>
						<td><input type="password" name="password"></td>
				</tr>
                <tr>
					<td>
					<h3>Phone number</h3>
					</td>
						<td><input type="text" name="phno"></td>
				</tr>
                <tr>
					<td>
					<h3>Email id</h3>
					</td>
						<td><input type="email" name="email"</td>
                </tr>
				<tr>
					<td colspan="2" align=center><h2> <input type="submit" name="submit" ></h2></td> 
				</tr>
            </table>
        </form>
    </body>
</html>
<?php
if(isset($_POST["submit"]))
{
$name=$_POST["name"];
$password=$_POST["password"];
$ph=$_POST["phno"];
$email=$_POST["email"];
if($name="")
{
echo '<script>alert("Please enter name");</script>';
}
if($password=="")
{
echo '<script>alert("Please enter password");</script>';
}
else if(strlen($password)<8)
{
echo '<script>alert("Password must contain atleast 8 digits");</script>';
}
if($ph=="")
{
echo '<script>alert("Please enter phonenumber");</script>';
}
else if(!ctype_digit($ph)||strlen($ph)!=10)
{
echo '<script>alert("Please enter valid phonenumber");</script>';
}
if($email=="")
{
echo '<script>alert("Please enter email");</script>';
}
}
?>