<?php
include'config.php';
	
	if(isset($_POST["Submit"])){
		session_start();
		$id=$_SESSION['CustomerID']; //User id

		//obtain input from the form
		$service_type = $_POST['service_type'];
		$booking_price = $_POST['booking_price'];
		$residence_type = $_POST['residence_type'];
		$bedroom_num = $_POST['bedroom_num'];
		$bathroom_num = $_POST['bathroom_num'];
		$extra_service = $_POST['extra_service'];
		$additional_notes = $_POST['additional_notes'];
		$start_time = $_POST['start_time'];
		$start_date = $_POST['start_date'];
		$card_holder = $_POST['card_holder'];
		$card_num = $_POST['card_num'];
		$mm_yy = $_POST['mm_yy'];
		$cvv = $_POST['cvv'];
		$customer_name = $_POST['customer_name'];
		$email = $_POST['email'];
		$phone_num = $_POST['phone_num'];
		$address = $_POST['address'];

		//Filter and Sanitize Form from the user input
		$service_type2 = sanitizeInput($service_type);
		$booking_price2 = sanitizeInput($booking_price);
		$residence_type2 = sanitizeInput($residence_type);
		$bedroom_num2 = sanitizeInput($bedroom_num);
		$bathroom_num2 = sanitizeInput($bathroom_num);
		$extra_service2 = sanitizeInput($extra_service);
		$additional_notes2 = sanitizeInput($additional_notes);
		$start_time2 = sanitizeInput($start_time);
		$start_date2 = sanitizeInput($start_date);
		$card_holder2 = sanitizeInput($card_holder);
		$card_num2 = sanitizeInput($card_num);
		$mm_yy2 = sanitizeInput($mm_yy);
		$cvv2 = sanitizeInput($cvv);
		$customer_name2 = sanitizeInput($customer_name);
		$email2 = sanitizeInput($email);
		$phone_num2 = sanitizeInput($phone_num);
		$address2 = sanitizeInput($address);

		//if the original value is not the same with the filtered and sanitized value, there are some SQL injection tags or special characters.
		if($service_type != $service_type2 || $booking_price != $booking_price2 || $residence_type != $residence_type2 || $bedroom_num != $bedroom_num2 || $bathroom_num != $bathroom_num2|| $extra_service != $extra_service2 || $additional_notes != $additional_notes2 || $start_time != $start_time2 || $start_date != $start_date2 || $card_holder != $card_holder2 || $card_num != $card_num2 || $mm_yy != $mm_yy2 || $cvv != $cvv2 || $customer_name != $customer_name2 || $email != $email2 || $phone_num != $phone_num2 || $address != $address2)
		{
			//Warn the use if SQL Injection attempt is detected.
			?>
        <script>
            alert('Action Failed because SQL INJECTION Attempt DETECTED');
        </script>
        <?php
			header("refresh:1; url=service.php");
		}
		else{//Else if SQL injection not detected, then smake the query to insert into database.

				$query1 ="INSERT INTO tbl_booking (`CustomerID`,`service_type`, `booking_price`, `residence_type`, `bedroom_num`, `bathroom_num`, `extra_service`, `additional_notes`, `start_time`, `start_date`, `card_holder`, `card_num`, `mm_yy`, `cvv`,  `customer_name`, `email`, `phone_num`, `address`) VALUES ('$id','$service_type', '$booking_price', '$residence_type', '$bedroom_num', '$bathroom_num', '$extra_service', '$additional_notes', '$start_time', '$start_date', '$card_holder', '$card_num', '$mm_yy', '$cvv', '$customer_name', '$email', '$phone_num', '$address')";

		
		

				if(mysqli_query($conn,$query1)){

						
						header("Location: confirm_booking.php");
					}

				
					mysqli_close($conn);
			}

	}

?>












