<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="slick-team-slider.css" />
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
	</script>	<!--link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script-->
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

	
	<div class="container txt-center">
		<h3></h3>
		<div>
			
		</div>
	</div>
	
	<div class="container" style="padding: 50px;">
		<h1 class="txt-center">BOOKING</h1>
		<div>
        
<!--CHOOSE BUS TICKTER AND PRICE-->
		<div class="container">
			<div class="booking-machine">
				<form action="<?php echo $_SERVER ['PHP_SELF']?>" method="post">
					<fieldset>
						<label>From:</label>
							<select name="departure_from">
								<option value="KUL">Kuala Lumpur</option>
								<option value="IPH">Ipoh</option>
								<option value="KTN">Kuantan</option>
								<option value="BTW">Butterworth</option>
							</select>
						<label>To:</label>
						<select name="arrive_to">
							<option value="KUL">Kuala Lumpur</option>
							<option value="IPH">Ipoh</option>
							<option value="KTN">Kuantan</option>
							<option value="BTW">Butterworth</option>
						</select>
						<label>Date: <input width="300" type="text" id="datepicker" name="date" ></label>
						<input class="searchButton" name="submit" type="submit" value="Search Trip" />        
					</fieldset>
			</form>
		      	</div>
		</div>
<!--CLOSE CHOOSE BUS TICKET-->

<!-- CHOOSE QUERY SUBMIT-->
<?php
// If you have selected from list box.
if(isset($_POST['submit'])) {
// Get records from database (table "id").
$departure_from=$_POST['departure_from'];
$date=$_POST['date'];
$arrive_to=$_POST['arrive_to'];
$query="SELECT * FROM bus WHERE departure_from=('$departure_from') AND arrive_to=('$arrive_to') OR date=('$date')";

$result=mysqli_query($connection,$query) or die('Error in query:$query.'.mysqli_error());
?>
<!--CLOSE QUERY SUBMIT-->

<!--PRINT BUS SCHEDULE-->
<?php
//check if records were returned
echo"<div class='container' style='padding: 50px;'><center>Your destinations from <b>".$departure_from."</b> To <b>".$arrive_to."</b> , <b>".$date."</b>";
if (mysqli_num_rows ($result) > 0)
{
    //print HTML table
	echo'<p>You Choose:</p>';
    echo '<table width=100% cellpading=10 cellspacing=0 border=1>';
    echo'<tr><td><b>ID</b></td><td><b>Departure From</b></td><td><b>Arrive to</b></td><td><b>Date</b></td><td><b>Time</b></td><td><b>Price</b></td></tr>';
    
    // iterate over record set
    // print each field
    while ($row = mysqli_fetch_row ($result))
    {
    echo '<tr>';
    echo '<td>' . $row[0] . '</td>';
    echo '<td>' . $row[1] . '</td>';
    echo '<td>' . $row[2] . '</td>';
	echo '<td>' . $row[3] . '</td>';
    echo '<td>' . $row[4] . '</td>';
	echo '<td>' . $row[5] . '</td>';
    echo '</tr>';
    }
    echo '</table>';
}

else
	{
		$query="SELECT * FROM bus ";
		$result=mysqli_query($connection,$query) or die('Error in query:$query.'.mysqli_error());

		//print error message
		echo ' is not available.<p> Other Bus Schedule Available</p>';
		//print HTML table
    echo '<table width=100% cellpading=10 cellspacing=0 border=1>';
    echo'<tr><td><b>ID</b></td><td><b>Departure From</b></td><td><b>Arrive to</b></td><td><b>Date</b></td><td><b>Time</b></td><td><b>Price</b></td></tr>';
    
    // iterate over record set
    // print each field
    while ($row = mysqli_fetch_row ($result))
    {
    echo '<tr>';
    echo '<td>' . $row[0] . '</td>';
    echo '<td>' . $row[1] . '</td>';
    echo '<td>' . $row[2] . '</td>';
	echo '<td>' . $row[3] . '</td>';
    echo '<td>' . $row[4] . '</td>';
	echo '<td>' . $row[5] . '</td>';
    echo '</tr>';
    }
    echo '</table>';
	}
    
// End if statement. 
mysqli_close($connection);
}
?></p>
</div> 
<div style="padding: 50px;" align="right" >
Check Your bus schedule here and click<a href="http://localhost/Website-DB/formframeset.php"><input class="searchButton" name="gotrip" type="reset" value="Go Trip"/></a></div>
<!--CLOSE BUS SCHEDULE-->
            
            
            
            
            
            
		</div>
</div>	
    
<!--FOOTER-->    
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
				<br><br><img width="15px" src="img/copyright-symbol.png">
				2019 Copyright <a style="text-decoration:none;" href="https://plusliner.com.my/">Plusliner.com</a></p>
				
				</td>
			</tr>
		</table>
		</div>
	</div>	
<!--CLOSE FOOTER-->

</body>
</html>


