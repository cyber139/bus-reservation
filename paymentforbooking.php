<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<!--guna link kat bawah ni kalau nak yg oren-->
	<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<!--Calendar punya script--> 
	<script>
		$(function() {
		$( "#datepicker" ).datepicker({ minDate:0, maxDate:40,dateFormat:'yy-mm-dd'});
		});
	</script>
</head>
<body>

<!--HEADER-->
	<div class="navbar">
		<a class="logo" href="http://localhost/Website-DB/homepage2.php"><img width="200px" src="img/PluslinerLogo001.png"></a>
		<div class="topnav-right">
			<a href="http://localhost/Website-DB/booking.php">Booking</a>
            <a href="http://localhost/Website-DB/homepage2.php#ourservice">Our Service</a>
			<a href="http://localhost/Website-DB/homepage2.php#aboutus">About Us</a>
            <a href="http://localhost/Website-DB/homepage2.php#contactus">Contact Us</a>
		</div>
	</div>
<!--CLOSE HEADER-->
    
 
<!--YOUR ID-->
<div class="container" style="padding-top: 100px;" align="center">
			<h2>Payment</h2>
			<p style="text-align:center"> (Via MasterCard or Visa only)</p>
  <?php
		//open connection to MySQL server
	$connection = mysqli_connect('localhost', 'guest', 'pass','busticket') or die ('Unable to connect!');
	
	if (!isset($_POST['submit']))
	{
	//form not submitted
	session_start();
	?>
    
	<form action="<?php echo $_SERVER ['PHP_SELF']?>" method="post">
	<p>Your ID		:<input type="text" name="cust_id" >   
	<input class="searchButton" name="submit" type="submit" value="Submit" />	
</form>	
	<?php
	
	}
	
else
	{
	$price='0.00';
	//get form input
	//escape input values for greater safety
	$cust_id= (trim($_POST['cust_id'] == '')|| !is_numeric($_POST['cust_id'])) ?die('ERROR: Inpur Your Customer ID'): $_POST['cust_id'];
	$_SESSION ['$cust_id'] = $cust_id;
	$_SESSION['$price']=('0.00');
	//create and execute query
	//SELECT price FROM customer,bus WHERE customer.cust_id = ('1003') AND bus.id=('121')
	$query = "SELECT bus_id FROM customer WHERE cust_id = ('$cust_id')";
	$results = mysqli_query ($connection,$query) or die ('Error in query : $query . ' . mysqli_error());
	echo "<p><h3>CUSTOMER ID	:	" . $cust_id;
	while ($row = mysqli_fetch_array($results)) {
       echo "<p><h3>BUS ID	:	" . $row[0];
	   $bus_id=$row[0];
	   $_SESSION ['$bus_id'] = $bus_id;
    }
	
	$query2 = "SELECT price FROM customer,bus WHERE customer.cust_id = ('$cust_id') AND bus.id=('$bus_id')";
	$results2 = mysqli_query ($connection,$query2) or die ('Error in query : $query . ' . mysqli_error());
	
	while ($row = mysqli_fetch_array($results2)) {
       echo "<p><h3>PRICE	:	" . $row[0];
	   $price=$row[0];
	   $_SESSION ['$price'] = $price;
	   
    }
	}
	?>
</div>    
<!--YOUR ID-->    
    
    
<!--PAYMENT METHOD-->
<div class = "booking-machine" style="width:150; margin-bottom:300px">

	<?php
	//session_start();

    if (!isset($_POST['Pay']))
	{
	//form not submitted
	?>
			<form action="<?php echo $_SERVER ['PHP_SELF']?>" method="post">
						Payment Method:<select name="method">
                        <option value="VISA">Visa</option>
                        <option value="MASTERCARD">MasterCard</option>
						</select><p>
						Payment Amount(RM)	:<?php echo $_SESSION['$price'];?> <p>
						Card Number			:<input type="text" name="cardnum"><p>
						Expiry Date			:<input type="text" name="expd"><p>
						Security Code(numbers behind your card):<input type="text" name="secnum"><p>
						Pin Number			:<input type="text" name="pin">
						
			<input class="searchButton" name="Pay" type="submit" value="Pay" /></form>
            
            

<?php
	}
	
	else{
	//get form input
	//escape input values for greater safety
	$paytotal =$_SESSION['$price'];
		$cardnum = (trim($_POST['cardnum']) == '')?die ('ERROR: Enter a valid Card Number!'): trim($_POST['cardnum']);
		$expd = (trim($_POST['expd']) == '')?die ('ERROR: Enter a valid Expiry Date!'):trim($_POST['expd']);
		$secnum = (trim($_POST['secnum']) == '')?die ('ERROR: Enter a valid Security number!'): trim($_POST['secnum']);
		$pin =  (trim($_POST['pin']) == '')?die  ('ERROR: Enter a valid pin number!'):trim($_POST['pin']);
	$bus_id=$_SESSION['$bus_id'];
	$cust_id=$_SESSION['$cust_id'];

		
		//create and execute query
	//$results = mysqli_query ($connection,$query) or die ('Error in query : $query . ' . mysqli_error());
	$query3 = "SELECT * FROM customer,bus WHERE customer.cust_id=('$cust_id') AND bus.id=('$bus_id')";
	$results3 = mysqli_query ($connection,$query3) or die ('Error in query : $query . ' . mysqli_error());
	echo' <div class="container" style="padding-top: 100px;" align="center">
			<h2>Booking Details</h2>
			<p style="text-align:center"><img class="img-why" src="https://i2.wp.com/nahbnow.com/wp-content/uploads/2018/08/iStock-692279620.jpg" alt="tick" title="tick"></p>
			<p style="text-align:center"> Payment Recieved</p>
	</div>';

	echo '<p><center> BOOKING DETAILS</center></p>';
	if (mysqli_num_rows ($results3) > 0)
	{
		//print HTML table
		// iterate over record set
		// print each field
		while ($row = mysqli_fetch_row ($results3))
		{
		echo 'Customer ID	:' . $row[0] . '<p>';
		echo 'Full Name		:' . $row[1] . '<p>';
		echo 'Phone			:' . $row[2] . '<p>';
		echo 'Identification Card / 
		Passport Number		:' . $row[3] . '<p>';
		echo 'Email			:' . $row[4] . '<p>';
		echo 'Gender		:';
		if($row[5]==1){
			echo 'Female';
			} 
			else{ 
			echo'Male';
			}
		echo '<p>Bus ID		:' . $row[6] . '<p>';
		echo 'Bus Seat		:' . $row[7] . '<p>';
		echo 'Departure From:' . $row[8] . '<p>';
		echo 'Arrive To		:' . $row[9] . '<p>';
		echo 'Date			:' . $row[10] . '<p>';
		echo 'Time			:' . $row[11] . '<p>';
		echo 'Price			:' . $row[12] . '<p>';
		echo '</tr>';
		}
		echo '</table>';
	}
	
else{
	echo'$paytotal $cardnum $expd $secnum $pin';
	echo' Your Payment have been made';
}
	
	}
$_SESSION['$price']=('0.00');
?>
</div>
<!--CLOSE CONTENT-->

    	
<!--CONTACT US/ FOOTER-->	
<div id="aboutus" class="container">
		<div>
		<table width="100%" >
			<tr>
				<td width="70%" >
				<h3>About Plusliner</h3>
				<ul class="foote" >
					<li><a href="aboutus.html" target="dynamic">About Us</a></li>
					<li><a href="contactus.html" target="dynamic">Contact Us</a></li>
					<li><a href="privacypolicy.html" target="dynamic">Privacy Policy</a></li>
				</ul>
				</td>
				
				<td>
				<br>
				<img padding="20" width="200px" src="img/PluslinerLogo001.png">
				<p style="line-height:1.5;">Plusliner is the Malaysia's largest bus service trusted by around 1 million citizens. Plusliner offers bus ticket booking through its website for all major routes in  Malaysia.
				<br><br><img width="15px" src="https://scontent-kut2-1.xx.fbcdn.net/v/t1.0-9/61193340_646827969115966_3234371696878157824_n.png?_nc_cat=102&_nc_ht=scontent-kut2-1.xx&oh=45145536083dc461ab125d5aecfa4cff&oe=5D535F21">
				2019 Copyright <a style="text-decoration:none;" href="https://plusliner.com.my/">Plusliner.com</a></p>
				
				</td>
			</tr>
		</table>
		</div>
	</div>
<!--CLOSE CONTACT US/FOOTER-->
	
</body>
</html>