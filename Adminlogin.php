<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['CustomerID'])) {
    header("Location: Home.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['Email'];
	$password = md5($_POST['Password']);

	$sql = "SELECT * FROM customer WHERE Email='$email' AND Password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
        $id = $row["CustomerID"];
        $firstname = $row["Firstname"];
        $lastname = $row["Lastname"];
        $email = $row["Email"];
        $phone = $row["Phone"];
        $password = $row["Password"];
        $image = $row["Image"];
        $address = $row["Address"];
        $_SESSION['CustomerID'] = $row['CustomerID'];
		$_SESSION['Firstname'] = $row['Firstname'];
        $_SESSION['Lastname'] = $row['Lastname'];
        $_SESSION['Email'] = $row['Email'];
        $_SESSION['Phone'] = $row['Phone'];
        $_SESSION['Password'] = $row['Password'];
        $_SESSION['Image'] = $row['Image'];
        $_SESSION['Address'] = $row['Address'];
		header("Location: Home.php");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="img/SCRUBB.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Welcome</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="images/SCRUBB.png">
        <link rel="stylesheet" href="css/customersignup.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
    </head>
	
    <body>
    

        <div class="split left" style='background-color: #F8E192;' >
            <div> 
	            <img src = "img/SCRUBB.png" width="200" 
     height="220"style='position:absolute; top:0; left:0; ' alt="Shop Logo"> 
           </div> 
            <div class = "centered">
                <img src = "img/ScrubbMainPage.png" alt="Shop Logo">
            </div>
        </div>

        <div class="split right">
             <div class="centered">
                <div class="wrapper">
                    <div class="title-text">
                        <div class ="title"> Welcome Back Admin!</div>
                    </div>
               
                    <div class ="form-container">
                     <div class="form-inner">
                            <form action="adminloginaction.php"  class="login" method="POST">
                                <div class="field">
                                    <input type="text" name ="Email" id="Email"placeholder="Email Address" >
                                </div>
                                <div class="field"> <!-- This password will be verified by using the password_verify()-->
                                    <input type="password" name = "Password" id="Password" placeholder="Password">

                                </br>
                                <div class="signup-link"> <a href="#">   Forgot Password?</a> </div>
                        
                            <span></span>
								
                                </div><br><br><br>
                               
                               
                                <div class="field">
                                    <input name="save" type="submit" value="Sign In">
                                </div>
							</form>
                     </div>
                    </div>
             </div>
           </div>
       </div>
    <script>
      const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');
 
  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>
</body>

</html>