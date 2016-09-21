<?php
	//vottab ja kooperib faili sisu
	require("../../config.php");


//"MVP idee"
// "Spordikeskuse veebileht kus oleks võimalik kasutada sooduskaarti, valida mis spordikursusi võib valida, treenerite ajakavad, hinnad, mingid üritused ja kampaaniad."
// "Kui sa ei lähe trenni siis sinu koht on kinni ja teised ei saa sinu asemel minna sinna."

	//var_dump(empty)
	
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
	//Muutujad
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupPhonenumberError = "";
	$PhonenumberError = "";
	$signupEmail = "";
	$gender = "";
	$genderError = "";
	// kas e-post oli olemas
	if ( isset ( $_POST["signupEmail"] ) ) {
		
		if ( empty ( $_POST["signupEmail"] ) ) {
			
			// oli email, kuid see oli tühi
			$signupEmailError = "See väli on kohustuslik!";
			
		} else {
			
			// email on õige, salvestan väärtuse muutujasse
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	}
	
	if ( isset ( $_POST["signupPassword"] ) ) {
		
		if ( empty ( $_POST["signupPassword"] ) ) {
			
			// oli password, kuid see oli tühi
			$signupPasswordError = "See väli on kohustuslik!";
			
		} else {
			
			// tean et parool on ja see ei olnud tühi
			// VÄHEMALT 8
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";
				
			}
			
		}
		
	}
	
	if(isset ($_POST["Phonenumber"])) {
		
		if (empty ($_POST["Phonenumber"])){
				
					$PhonenumberError = "Palun sisestage oma number";
		}

	}

	
	// KUI Tühi
	// $gender = "";
	
	if ( isset ( $_POST["gender"] ) ) {
		if ( empty ( $_POST["gender"] ) ) {
			$genderError = "See väli on kohustuslik!";
		} else {

		}
	}
	
	// Kus tean et ühtegi viga ei olnud ja saan kasutaja andmed salvestada
	if ( isset($_POST["signupPassword"]) &&
		 isset($_POST["signupEmail"]) &&	
		 empty($signupEmailError) && 
		 empty($signupPasswordError)
	   ) {
		
		echo "Salvestan...<br>";
		echo "email ".$signupEmail."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "parool ".$_POST["signupPassword"]."<br>";
		echo "räsi ".$password."<br>";
		
		//echo $serverUsername;
		//echo $serverPassword;
		
		$database = "if16_mikuz_1";
		
		//Uhendus olemas
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		
		//Kask
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		
		//asendan kusimargi vaartustega
		//iga muutuja kohta 1 taht, mis tuupi muutuja on
		//s - string
		//i - integer
		//d - double/float
		$stmt->bind_param("ss", $signupEmail, $password);
		
		if($stmt->execute()) {
			
			echo "Salvestamine onnestus";
		}else{
			echo "ERROR".$stmt->error;
		}
		
		
	}
	
	
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise lehekulg</title>
	</head>
	<body>

		<h1>Logi Sisse</h1>

		<form method = "POST">
		
			<label> E-post</label><br>

			<input name = "LoginEmail" type = "email">
			
			<br><br>
			
			<input name = "LoginPassword" type = "password" placeholder  = "Parool"> 
			
			<br><br>
			
			<input type = "submit" value = "Logi sisse">
		
		</form>
		
		<h1> Loo kasutaja </h1/>
		
			<form method = "POST">
			
			<label> E-post</label><br>
			
			<input name = "signupEmail" type = "email" value="<?php echo $signupEmail;?>">  <?php echo $signupEmailError; ?>
			
			<br><br>
			
			<input name = "signupPassword" type = "password" placeholder  = "Parool">  <?php echo $signupPasswordError; ?>
			
			<br><br>
		
			<form method = "POST">
			
			<label> Telefoni number </label><br> 
			
			<input type="tel" name="Phonenumber" placeholder  = "12345678"	pattern="[0-9]{8}"> <?php echo $PhonenumberError; ?>
			
			<br><br>
			
			<form method = "POST">
		
			<label> Male/Female</label><br><br>
			
			 <?php if($gender == "Male") { ?>
				<input type="radio" name="gender" value="male" checked> Male<br>
			 <?php } else { ?>
				<input type="radio" name="gender" value="male" > Male<br>
			 <?php } ?>
			 
			 <?php if($gender == "Female") { ?>
				<input type="radio" name="gender" value="female" checked> Female<br>
			 <?php } else { ?>
				<input type="radio" name="gender" value="female" > Female<br>
			 <?php } ?>
			 
			 <?php if($gender == "other") { ?>
				<input type="radio" name="gender" value="other" checked> Other<br>
			 <?php } else { ?>
				<input type="radio" name="gender" value="other" > Other<br>
			 <?php } ?>
			
			<br><br>
			
			<form method = "POST">
			
			<label>Birthday (month and year):</label>
			
			<input type="month" name="monthandyear">
			
			<br><br>
			
			<input type = "submit" value = "Registreeru">
			
		</form>
	
	</body>
	
</html>

<html>
	<body>
		<h1>MVP IDEE</h1>
		<form>
		Spordikeskuse veebileht kus oleks võimalik kasutada sooduskaarti, valida mis spordikursusi võib valida, treenerite ajakavad, hinnad, mingid üritused ja kampaaniad.
		Kui sa ei lähe trenni siis sinu koht on kinni ja teised ei saa sinu asemel minna sinna.
		</form>
	</body>
</html>