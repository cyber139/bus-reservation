<!DOCTYPE html>
<html>
<head>
<!DOCTYPE html>
<html>
<head>
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
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<!--CONNECTION-->
<?php

	// If submitted, check the value of "select". If its not blank value, get the value and put it into $select.
	$connection = mysqli_connect('localhost', 'guest', 'pass','busticket') or die ('Unable to connect!');
	if(isset($select)&&$select!=""){
	$select=$_POST['select'];
	}
?>
<!--CLOSE CONNECTION-->

    
 
<!--HEADER-->
<div class="navbar">
		<a class="logo" href="index.php"><img width="200px" src="img/PluslinerLogo001.png"></a>
		<div class="topnav-right">
			<a href="http://localhost/Website-DB/booking.php">Booking</a>
            <a href="index.php#ourservice">Our Service</a>
			<a href="index.php#aboutus">About Us</a>
            <a href="index.php#contactus">Contact Us</a>
		</div>
	</div>
<!--CLOSE HEADER-->

<!--CONTENT-->
<div class="container" style="padding: 100px; text-align:center">	  
<h1 class="txt-center">FORM</h1>
<table width="100%" >
			<tr>
				<td width="60%">
                 <!--SEAT AVAILABILITY-->
                <!--SEAT NUMBER-->
                 <div class="container" style="padding: 70px;" align="center">
                    <p style="text-align:center">Choose Your Seat</p>	                
                    <?php
					

                        if (!isset($_POST['check']))
                        {
                        //form not submitted
                        ?>
                      </p>
                        <form action="<?php echo $_SERVER ['PHP_SELF']?>" method="post">	
                    
                    <p>Seat Number : <p>
                        <input type="radio" name="seatno" value="A1">A1
                        <input type="radio" name="seatno" value="B1">B1
                        <input type="radio" name="seatno" value="C1">C1
                        <input type="radio" name="seatno" value="D1">D1
                        <input type="radio" name="seatno" value="E1">E1
                        <input type="radio" name="seatno" value="F1">F1<br>
                        <input type="radio" name="seatno" value="A2">A2
                        <input type="radio" name="seatno" value="B2">B2
                        <input type="radio" name="seatno" value="C2">C2
                        <input type="radio" name="seatno" value="D2">D2
                        <input type="radio" name="seatno" value="E2">E2
                        <input type="radio" name="seatno" value="F2">F2<p>
                        <input type="radio" name="seatno" value="A3">A3
                        <input type="radio" name="seatno" value="B3">B3
                        <input type="radio" name="seatno" value="C3">C3
                        <input type="radio" name="seatno" value="D3">D3
                        <input type="radio" name="seatno" value="E3">E3
                        <input type="radio" name="seatno" value="F3">F3</p>
                        <p><input type= "submit" name= "check" value="Check Availability">
                    </form>	
                    
                    <?php
                        }
                        
                    else
                        {
						$seatno=(trim($_POST['seatno']) == '')?die('ERROR: Check the availability of your seat number'): $_POST['seatno'];
                        $query1="SELECT COUNT('busseat') FROM customer WHERE busseat=('$seatno')";
						
						
                        $result1 = mysqli_query ($connection,$query1) or die ('Error in query : You have entered invalid information. The information has been filled. ' . mysqli_error());
                        
                            if(mysqli_num_rows ($result1)>0){
								
								while ($row = mysqli_fetch_row ($result1))
								{
									echo $busseat=$row[0] . "\n";
								}
								if($busseat>0){
										echo '<p> This seat is Occupied, Choose Other seat';
										echo'<p> <div style="padding: 50px;" align="right" >';
										echo'Check Other bus seat and click<a href="http://localhost/Website-DB/formframeset.php"><input class="searchButton" name="gotrip" type="reset" value="Check"/></a></div>';
								}
										
										
									else{
										 //create and execute query
										  echo "<p>The Seat $seatno is Available. Please input the avalaible seat in your form.";
										  echo'<p> <div style="padding: 50px;" align="right" >';
										echo'Check Other bus seat and click<a href="http://localhost/Website-DB/formframeset.php"><input class="searchButton" name="gotrip" type="reset" value="Check"/></a></div>';
										 }
								
							}
							
							else{
										//create and execute query
										 echo 'MASALAH APA PULAK NI';
										 }
								
					}
                        
                    
                        ?>
                        
                  <!--CLOSE SEAT AVAILIBITLITY-->
                </p>
                </td>
				<td bordercolor="#000000">
                <!--PASSENGER DETAILS-->
                <div class="container" style="padding: 10px; text-align:left;">	  
                    <p style="text-align:center">Passenger Details</p>
                    <p>
                  <?php
                    if (!isset($_POST['submit']))
                    {
                    //form not submitted
                    ?>
                  </p>
                    <form action="<?php echo $_SERVER ['PHP_SELF']?>" method="post">
                    <p>Your Full Name		:<input type="text" name="cust_fullname" >
                    <p>Phone Number			:<input type="text" name="phone">
                    <p>IC Number / Passport :<input type="text" name="ic">
                    <p>Email				:<input type="text" name="email">
                    <p>Gender :
                    <input type="radio" name="gender" value="1">Female
                    <input type="radio" name="gender" value="2">Male
                    <p>
                    <p>Bus ID :
                        <?php
                
                            $query = "SELECT * FROM bus ORDER BY id ASC";
                            $results = mysqli_query ($connection,$query) or die ('Error in query : $query . ' . mysql_error());
                
                            echo "<select name='id'>";
                            while ($row = mysqli_fetch_array($results)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['id'] . "</option>";
                            }
                            echo "</select>";
                
                        ?>
						<label><P>Bus Seat No		:</label>
							<select name="busseat">
								<option value="A1">A1</option>
								<option value="A2">A2</option>
								<option value="A3">A3</option>
								<option value="B1">B1</option>
								<option value="B2">B2</option>
								<option value="B3">B3</option>
								<option value="C1">C1</option>
								<option value="C2">C2</option>
								<option value="C3">C3</option>
								<option value="D1">D1</option>
								<option value="D2">D2</option>
								<option value="D3">D3</option>
								<option value="E1">E1</option>
								<option value="E2">E2</option>
								<option value="E3">E3</option>
								<option value="F1">F1</option>
								<option value="F2">F2</option>
								<option value="F3">F3</option>
                               	</select>
								
                    <p><input type= "submit" name= "submit" value="SUBMIT">
                </form>	
                    <?php
                    }
                    
                else
                    {
                    //get form input
                    //escape input values for greater safety
                    $cust_fullname = (trim($_POST['cust_fullname']) == '')?die ('ERROR: Enter  Full Name'):$_POST['cust_fullname'];
                    $phoneno = (trim($_POST['phone']) == '')?die ('ERROR: Enter Phone Number'):$_POST['phone'];
                    $ic = (trim($_POST['ic']) == '')?die ('ERROR: Enter Your IC/Passport Number'):$_POST['ic'];
                    $email = (trim($_POST['email']) == '')?die ('ERROR: Enter Valid Email Address'):$_POST['email'];
                    $gender= (trim($_POST['gender'] == '')|| !is_numeric($_POST['gender'])) ?die('ERROR: Choose Your gender'): $_POST['gender'];
                    $bus_id= (trim($_POST['id'] == '')|| !is_numeric($_POST['id'])) ?die('ERROR: Choose Your bus id'): $_POST['id'];
                    $busseat=(trim($_POST['busseat']) == '')?die ('ERROR: Enter Bus Seat Avalaible'):$_POST['busseat'];
                    //create and execute query
                    $query = "INSERT INTO  `customer` (`cust_fullname`, `phone`, `ic`, `email`, `gender`,`bus_id`,`busseat`) VALUES ( '$cust_fullname', '$phoneno', '$ic', '$email', '$gender','$bus_id','$busseat')";
					//
                    $results = mysqli_query ($connection,$query) or die ('Error in query : You have entered invalid information. The information has been filled. ' . mysqli_error());
                    
                    //print ID of inserted record
                    echo 'New record inserted.<p>Your Customer ID is :'. mysqli_insert_id($connection).'<br \>';
                
                    
                    //print number of rows affected
                    echo mysqli_affected_rows($connection) . ' record(s) affected';
					
					echo'<p> <div style="padding: 50px;" align="right" >';
					echo'<a href="http://localhost/Website-DB/paymentforbooking.php"><input class="searchButton" name="gotrip" type="reset" value="PAY NOW"/></a></div>';
                    
                    echo'<p></p>';
                    }
                    ?>
                </div>
                <!--CLOSE PASSENGER-->
				</td>
			</tr>
		</table>
</div>
<!--CLOSE CONTENT->


<!--FOOTER-->	
<div id="aboutus" class="container" style="padding:50px;">
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
<!--FOOTER-->
</body>
</html>


