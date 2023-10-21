<?php
    //connection file with the filter function
    include'config.php';
    //if user click update button
    if(isset($_POST['update'])){
        //start the session
        session_start();
        //get data from the session
        $id=$_SESSION['CustomerID'];

        //get data from form using post method
        $newfirstname=$_POST['firstname'];
        $newlastname=$_POST['lastname'];
        $newemail=$_POST['email'];
        $newphone=$_POST['phone'];
        $newaddress=$_POST['addrss'];
        $newpassword= md5($_POST['pass']);

        //filter and sanitize user inout from SQL injection
        $newfirstname2= sanitizeInput($newfirstname);
        $newlastname2= sanitizeInput($newlastname);
        $newemail2= sanitizeInput($newemail);
        $newphone2= sanitizeInput($newphone);
        $newaddress2= sanitizeInput($newaddress);

        //When original input not the same after filter, then there are SQL injection Attempt
        if($newaddress != $newaddress2 || $newphone != $newphone || $newemail != $newemail2 || $newlastname != $newlastname2 || $newfirstname != $newfirstname2){
          //Give warning if SQL injection attemp detected  ?>
        <script>
            alert('Action Failed because SQL INJECTION Attempt DETECTED');
        </script>
        <?php
        header("refresh:1; url=Manageprofile.php");
        }
        else{
             //the query needed for update
            $query1="UPDATE customer SET Firstname='$newfirstname' WHERE CustomerID='$id'";
            $query2="UPDATE customer SET Lastname='$newlastname' WHERE CustomerID='$id'";
            $query3="UPDATE customer SET Email='$newemail' WHERE CustomerID='$id'";
            $query4="UPDATE customer SET Phone='$newphone' WHERE CustomerID='$id'";
            $query5="UPDATE customer SET Addrss='$newaddress' WHERE CustomerID='$id'";
            $query6="UPDATE customer SET Pass='$newpassword' WHERE CustomerID='$id'";
        
            if(!$conn){
                die("Connection: Failed" .mysqli_connect_error());
            }
            //execute the query
            $result1=mysqli_query($conn,$query1);
            $result2=mysqli_query($conn,$query2);
            $result3=mysqli_query($conn,$query3);
            $result4=mysqli_query($conn,$query4);
            $result5=mysqli_query($conn,$query5);
            $result6=mysqli_query($conn,$query6);
        



            if(!$result1 || !$result2 ||!$result3 ||!$result4||!$result5 ||!$result6){
                //the update have fail
                header("Refresh: 0.1; url= Manageprofile.php");
                echo '<script>alert("Unable update your details")</script>';
            }
            else{
                //update successful and update the session data
                $_SESSION["Firstname"] = $newfirstname;
                $_SESSION["Lastname"] = $newlastname;
                $_SESSION["Email"] = $newemail;
                $_SESSION["Phone"] = $newphone;
                $_SESSION["Addrss"] = $newaddress;
                $_SESSION["Pass"] = $newpassword;

                
                header("Refresh: 0.1; url= Manageprofile.php");
                echo '<script>alert("You have update your details")</script>';

            }
        }

    }
    //if user click cancel button
    if(isset($_POST['cancel'])) {
        header("Refresh: 0.1; url= Manageprofile.php");
        echo '<script>alert("You have cancel to update your details")</script>';
    }
?>