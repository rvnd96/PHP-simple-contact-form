<?php 
$NameError="";
$EmailError="";
$GenderError="";
$WebsiteError="";
$nameValidation = "/^[A-Za-z\. ]*$/";
$emailValidation = "/[a-zA-Z0-9\._-]{3,}@[a-zA-Z0-9\._-]{2,}[.]{1}[a-zA-Z0-9._-]{2,}/";
$websiteValidation = "/(https:|ftp:|http:)\/\/+[a-zA-Z0-9.\-_\/?\$=&\#\~`!]+\.[a-zA-Z0-9.\-_\/?\$=&\#\~`!]*/";


if(isset($_POST["Submit"])) {
	if(empty($_POST["Name"])) {
		$NameError = "Name is required!";
	} else {
		$Name = Test_User_Input($_POST["Name"]);

		if(!preg_match($nameValidation, $Name)){
			$NameError = "Only letters and white spaces are allowed!";
		} /*Validation for name*/
	} /*for Name*/


	if(empty($_POST["Email"])) {
		$EmailError = "Email is required!";
	} else {
		$Email = Test_User_Input($_POST["Email"]);

		if(!preg_match($emailValidation, $Email)){
			$EmailError = "Invalid email format";
		} /*Validation for Email*/
	} /*for Email*/


	if(empty($_POST["Gender"])) {
		$GenderError = "Gender is required!";
	} else {
		$Gender = Test_User_Input($_POST["Gender"]);
	} /*For Gender*/


	if(empty($_POST["Website"])) {
		$WebsiteError = "Website is required!";
	} else {
		$Website = Test_User_Input($_POST["Website"]);

		if(!preg_match($websiteValidation, $Website)){
			$WebsiteError = "Invalid website format";
		} /*Validation for Website*/
	} /*For Website*/
} /*is set*/

/*Showing entered data*/
if (!empty($_POST["Name"]) && !empty($_POST["Email"]) && !empty($_POST["Gender"]) && !empty($_POST["Website"])) {
	if ( (preg_match($nameValidation, $Name)==true) && (preg_match($emailValidation, $Email)==true) && (preg_match($websiteValidation, $Website)==true) ) {
		echo "<h2>Your Information</h2><br>";
		echo "Name: " .ucwords($_POST["Name"]). "<br>";
		echo "Email: {$_POST["Email"]}<br>";
		echo "Gender: {$_POST["Gender"]}<br>";
		echo "Website: {$_POST["Website"]}<br>";
		echo "Comment: {$_POST["Comment"]}<br>"; /*validations*/

		/*Sending Email*/
		$emailTo="00rvnd@gmail.com";
		$subject="Contact Form";
		$body="Person Name is " . $_POST["Name"] . " who is a " . $_POST["Gender"] . ", with the email of " . $_POST["Email"]. " and website of " .$_POST["Website"]. " has commented as " .$_POST["Comment"];
		$sender="From:00rvnd@gmail.com";

		if(mail($emailTo, $subject, $body, $sender)){
			echo '<span class="success_email">E-mail sent successfully</span>';
		} else {
			echo '<span class="error">Email not sent</span>';
		}
		/*Sending Email | End*/

	} else {
		echo '<span class="error">Please complete and correct your form again!</span>';
	}
	
} /*not empty the fields*/


function Test_User_Input($Data) {
		return $Data;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Simple Form Validation Project</title>
	<style type="text/css">
		input[type="text"], input[type="email"], textarea {
			border: 1px solid blue;
			border-radius: 5px;
			background-color: #3240a8;
			color: #fff;
			width: 600px;
			padding: .5em;
			font-size: 1em;
			font-family: "Lucida Handwriting", Cursive;
		}
		.error{
			color: red;
		}
		fieldset {
			background-color: #182266;
			color: #fff;
		}
		#submit_btn{
			width: 300px;
			padding: 1em;
			border: 1px solid blue;
			border-radius: 5px;
			background-color: #5ab7cc;
			color: #22373d;
			font-family: "Lucida Handwriting", Cursive;
		}
		#submit_btn:hover {
			background-color: red;
			color: #fff;
		}
		.success_email{
			color: green;
		}
	</style>
</head>
<body>
	<h2>Form Validation with PHP</h2>
	<hr>
	<form action="form.php" method="post">
		<legend>* Please fill out the following fields.</legend>
		<fieldset>
			Name: <br>
			<input type="text" class="input" name="Name"><span class="error">*<?php echo $NameError; ?></span> <br>

			Email: <br>
			<input type="text" class="input" name="Email"><span class="error">*<?php echo $EmailError; ?></span><br>

			Gender: <br>
			<input type="radio" class="radio" name="Gender" value="Male">Male
			<input type="radio" class="radio" name="Gender" value="Female">Female <span class="error">*<?php echo $GenderError; ?></span><br>

			Website: <br>
			<input type="text" class="input" name="Website"><span class="error">*<?php echo $WebsiteError; ?></span><br>

			Comment: <br>
			<textarea name="Comment" cols="30" rows="10"></textarea><br><br>

			<input id="submit_btn" type="submit" name="Submit" value="Submit your information">
		</fieldset>
	</form>
</body>
</html>