<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","root","","authentication");
if(isset($_POST['login_btn']))
{
    $username=($_POST['username']);
    $password=($_POST['password']);
    $password=md5($password); //Remember we hashed password before storing last time
    $sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result=mysqli_query($db,$sql);
    if(mysqli_num_rows($result)==1)
    {
        $_SESSION['message']="You are now Loggged In";
        $_SESSION['username']=$username;
        header("location:doctors.html");
    }
   else
   {
                $_SESSION['message']="Username and Password combiation incorrect";
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
<form method="post" action="login.php">
  <table>
     <tr>
           <td>Username : </td>
           <td><input type="text" name="username" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
      <tr>
           <td></td>
           <td><input type="submit" name="login_btn" class="Log In" value="Login"></td>
     </tr>
 
</table>
</form>
</body>
</html>


