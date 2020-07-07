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
		<a class="logo" href="http://localhost/Website-DB/homepage2.php"><img width="200px" src="img/PluslinerLogo001.png"></a>
		<div class="topnav-right">
			<a href="http://localhost/Website-DB/booking.php">Booking</a>
            <a href="http://localhost/Website-DB/homepage2.php#ourservice">Our Service</a>
			<a href="http://localhost/Website-DB/homepage2.php#aboutus">About Us</a>
            <a href="http://localhost/Website-DB/homepage2.php#contactus">Contact Us</a>
		</div>
	</div>
<!--CLOSE HEADER-->
        
<!--CHOOSE BUS FROM AND TO-->
<div class="bg-img">
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
						<label>Date: <input width="300" type="text" id="datepicker" name="date"></label>
						<input class="searchButton" name="submit" type="submit" value="Search Trip" />
					</fieldset>
			</form>
		</div>
	 </div>
</div>
           
<!--CLOSE CHOOSE DESTINATIONS FROM TO-->

<!-- CHOOSE QUERY SUBMIT-->
<?php
// If you have selected from list box.
if(isset($_POST['submit'])) {
// Get records from database (table "id").
$departure_from=$_POST['departure_from'];
$date=$_POST['date'];
$arrive_to=$_POST['arrive_to'];
$query="SELECT * FROM bus WHERE departure_from=('$departure_from') AND arrive_to=('$arrive_to')  OR date=('$date')";

$result=mysqli_query($connection,$query) or die('Error in query:$query.'.mysqli_error());
?>


<!--PRINT OUT BUS SCHEDULE-->
<?php
//check if records were returned
echo"<div class='container' style='padding: 50px;'><center>Your destinations from <b>".$departure_from."</b> To <b>".$arrive_to."</b>";
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

echo'<div style="padding: 50px;" align="right" >';
echo'Check Your bus schedule and click<a href="http://localhost/Website-DB/formframeset.php"><input class="searchButton" name="gotrip" type="reset" value="Go Trip"/></a></div>';
    
// End if statement. 
mysqli_close($connection);
}
?></p>
<!--END OF QUERY SUBMIT-->









<!--Our Service-->
	<div id="ourservice" class="container txt-center" style="padding: 20px;">
		<div>
        <h3>&nbsp;</h3>
        <h3>Book Online and Save More!</h3>
			<img width="500" src="https://scontent-kut2-1.xx.fbcdn.net/v/t1.0-9/60895954_646828059115957_768245340015951872_n.png?_nc_cat=108&_nc_ht=scontent-kut2-1.xx&oh=b2cba1845b56ba0494bd8dd7abf40400&oe=5D5F7FB7" alt="Plusliner Bus" title="Plusliner Bus">
		</div>
	</div>

<div class="container" style="padding: 30px;">
		<h3 class="txt-center">Why You Won't Regret Booking With Us?</h3>
		<div>
			<table class="why" align="center">
			<tr>
				<td><img class="img-why" src="https://scontent-kut2-1.xx.fbcdn.net/v/t1.0-9/61210123_646828105782619_7719206251355176960_n.png?_nc_cat=105&_nc_ht=scontent-kut2-1.xx&oh=6489a6fa7db30bce626a8669a93cf77f&oe=5D599589" alt="Plusliner Bus" title="Plusliner Bus">
				<br>Top Service You Can Never Curse At!</td>
				<td><img class="img-why" src="https://scontent-kut2-1.xx.fbcdn.net/v/t1.0-9/60703069_646828012449295_6434403304863694848_n.png?_nc_cat=107&_nc_ht=scontent-kut2-1.xx&oh=85a736ed6d0ca336b026a26fc639b59e&oe=5D676869" alt="Plusliner Bus" title="Plusliner Bus">
				<br>Eat As Much As You Can!</td>
				<td><img class="img-why" src="https://scontent-kut2-1.xx.fbcdn.net/v/t1.0-9/60333768_646828099115953_8502317005758529536_n.png?_nc_cat=103&_nc_ht=scontent-kut2-1.xx&oh=c084515fd43a3e61ec394df88724b20a&oe=5D6739C1" alt="Plusliner Bus" title="Plusliner Bus">
				<br>Craziest Deal You'll Ever Get!</td>
			</tr>
		</table>
		</div>
	</div>
<!--CLOSE OUR SERVICE-->

<!--ABOUT US-->
<div id="aboutus" class="container txt-center">
	<div style="padding-top:50px;">
    <h1 style="text-align:center; color:darkblue;">About Us</h1>
		<img class="img-why" src="img/question.png" align="left"> 
		<h3 style="text-align:left; padding-left:50px; color:#58949C;">Who Are We?</h3>
		<div class="container txt-center">
			<p style="padding-bottom:40px;"> Plusliner is the Malaysia's largest express bus service trusted by around 1 million citizens. Plusliner offers bus ticket booking through its website for all major routes in Malaysia. From short local charters to all-day to multi-destination and trips, we are here and ready to serve.</p>
		</div>
		<img class="img-why" src="img/certificate.png" align="left";>
		<h3 style="text-align: left; padding-left:50px; color:#58949C;">Our Credentials</h3>
		<div class="container txt-center">
			<p style="padding-bottom:40px;"> With the most extensive network of bus services in Malaysia through more than 500 buses with more than 20 routes, plus more than 1,000 trips per day, Plusliner today is arguably the largest community of bus travellers in the country.</p>			
		</div>
		<img class="img-why" src="img/bus.png" align="left";>
		<div class="container txt-center">
			<h3 style="text-align: left; padding-left:50px; color:#58949C;">So, Why Book With Us?</h3>
			<p style="padding-bottom:40px;"> Plusliner has the most uncomplicated and hassle-free booking experience ever. Choose your destination, view the seat layout, choose convenient seats, and book your ticket in just a few clicks! We have a dedicated customer-care team to cater for your needs while you are on-the-go. We seek regular feedback from our customers and are always striving to better ourselves!</p>			
		</div>	
	</div>
</div>
<!--CLOSE ABOUT US-->

<!--CONTACT US-->
<style>
p {line-height:1.5; text-align: justify; text-justify: inter-word; }
.title {color:lightgreen; }
</style>
<div id="contactus" class="container txt-center">
	<div style="padding-top:50px;">
    <h1 style="text-align:center; color:darkblue;">Contact Us</h1>
    <table class="contact" align="center">
			<tr>
				<td> <img class="img-why" src="img/map.png" align="center"> 
        		<h3 style="color:#58949C; text-align:center;">Location Address</h3>
				<p style="text-align:center;"> Konsortium Transnasional Berhad,<br> 38, Jalan Chow Kit,<br>50350 Kuala Lumpur.</p>
				</td>
				<td><img class="img-why" src="img/phone-call.png" align="center";>
       			<h3 style="text-align: center; color:#58949C;">Hotline</h3>
				<p style="padding-bottom:80px; text-align:center"> +603-4045-8878</p>			
				</td>
				<td><img class="img-why" src="img/gmail.png" align="center";>
		  		<h3 style="text-align: center; color:#58949C;">Email</h3>
				<p style="padding-bottom:100px; text-align:center"> talk2us@ktb.com.my</p></td>
            </tr>
		</table>			
		</div>	
</div>
</div>

<!--CLOSE CONTACT US-->
    	
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


