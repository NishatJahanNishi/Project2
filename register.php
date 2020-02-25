<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","root","","authentication");
if(isset($_POST['register_btn']))
{
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];  
     if($password==$password2)
     {           //Create User
            $password=md5($password); //hash password before storing for security purposes
            $sql="INSERT INTO users(username,email,password) VALUES('$username','$email','$password')";
            mysqli_query($db,$sql);  
            $_SESSION['message']="You are now logged in"; 
            $_SESSION['username']=$username;
            header("location:doctors.html");  
    }
    else
    {
      $_SESSION['message']="The two password do not match";   
     }
	 
}
?>




<!DOCTYPE html>
<html>
<head>
  <title>Hospital Management System</title>
  <link rel="stylesheet" type="text/css" href="style1.css"/>
</head>
<body>
<div class="header">
    <h1>Hospital Management System</h1>
</div>
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
		<h3 class="h3">User Information:</h3>

<form method="post" action="register.php">
  <table>
     <tr>
           <td>Username : </td>
           <td><input type="text" name="username" class="textInput"></td>
     </tr>
     <tr>
           <td>Email : </td>
           <td><input type="email" name="email" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
      <tr>
           <td>Confirm Password: </td>
           <td><input type="password" name="password2" class="textInput"></td>
     </tr>
      <tr>
           <td></td>
           <td>
		   <input type="submit" name="register_btn" value="Register" class="Register">
		   </td>
		   
			<td><div class="user"> 
				<a href="login.php"><button type="button" name="login_btn" class="Log In">Login</button></a>
		   </div></td>
		   
		   
     </tr>
 
</table>
</form>
</body>
</html>
