<?php
include "index.php";
if(isset($_POST['submit']))
{
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $gender=$_POST['gender'];

    $sql="INSERT INTO `users`(`firstname`,`lastname`,`password`,`email`,`gender`) VALUES ('$firstname','$lastname','$password','$email','$gender')";

    $result=$conn->query($sql);
    
    if($result==TRUE)
    {
        header("Location:view.php");
        echo "new records created successfully";
    }
    else
    {
        echo "Error..".$sql."<br>".$conn->error;
    }
    $conn->close(); 
}
  

?>

<!DOCTYPE html>

<html>

<body>

<h2>Signup Form</h2>

<form action="" method="POST">

  <fieldset>

    <legend>Personal information:</legend>

    First name:<br>

    <input type="text" name="firstname" required>

    <br>
    Last name:<br>

<input type="text" name="lastname" required>

<br>

    password:<br>
    <input type="password" name="password" required>

    <br>

    Email:<br>

    <input type="email" name="email" required>

    <br>

   
    Gender:<br>

    <input type="radio" name="gender" value="Male">Male

    <input type="radio" name="gender" value="Female">Female

    <br><br>

    <input type="submit" name="submit" value="submit">

  </fieldset>

</form>

</body>

</html>