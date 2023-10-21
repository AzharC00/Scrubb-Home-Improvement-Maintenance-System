<?php
    session_start();
    //obtain data from the form of Login.php using POST method
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    //Print the Email, Password
    echo "Email: "; 
    echo $email;
    echo "<br>";
    echo "Password: "; 
    echo $password;
    echo "<br><br>";
    
     //Create Connection
     $server = "localhost";
     $username = "root";
     $dbpassword = "";
     $dbname = "scrubb";
 
     $conn = mysqli_connect($server, $username, $dbpassword, $dbname);
 
     if(!$conn){
         die("Connection: Failed" .mysqli_connect_error());
     }
    /*echo "Connected Successfully";
    echo "<br><br>";*/
 

    if(empty($_POST['Email']) || empty($_POST['Password'])){
        header("Refresh: 0.1; url= Login.php");
        echo '<script>alert("Both fileds are required")</script>)';
    }
    else{
        /* Get data from the AccountCustomerLogin.php */
        $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
        $Password = mysqli_real_escape_string($conn, $_POST["Password"]); 
        $query = "SELECT * FROM admin WHERE AdminEmail = '$Email'";
        $result = mysqli_query($conn, $query);
    
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                if($Password == $row["AdminPassword"]){
                    //return true
                    //Get Information from the same row for other details.
                    $ID = $row["AdminID"];
                    $uname = $row["AdminName"];
                    $emailfromdb = $row["AdminEmail"];
                    $passfromdb = $row["AdminPassword"];
                    $_SESSION["ID"] = $ID;
                    $_SESSION["Username"] = $uname;
                    $_SESSION["Email"] = $emailfromdb;
                    $_SESSION["Password"] = $passfromdb;
                    
                    // Go to Home page and display sucessful login
                    header("Refresh: 0.1; url= Dashboard.php");
                    //echo "Hello, " . $_SESSION["Username"] . ".";
                    echo '<script>alert("Welcome, Going to dashboard now.")</script>';
                }
                else{
                    //return false
                    header("Refresh: 0.1; url= AdminLogin.php");
                    echo '<script>alert("Wrong Credential")</script>';
                }
            }
    
        }
        else{
            header("Refresh: 0.1; url= AdminLogin.php");
            echo '<script>alert("Wrong Credential")</script>';
        }
        
    }   
    echo "<br><br>";
    //Close Connection (Security Measure)
    $resultclose = mysqli_close($conn);
    //Check if the connection closed successfully
    /*
    if($resultclose){
        echo " Close Connection Successful";
    }
    else{
        echo "Failed To close connection";
    }
    */
?>