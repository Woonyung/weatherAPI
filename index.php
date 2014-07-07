<?php

	$city = "New york"; //for JSON without this, it works

	if(isset($_POST['city'])){
		$city = $_POST['city'];
	}



	$data = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$city."&mode=json&units=imperial");
	$json = json_decode($data);

	//parsing the data
	$city= $json->name;
	$temperatureF = $json->main->temp;
	$temperatureC = ($temperatureF  -  32)*5/9;

	//////////round//////////////
	$tempF = round($temperatureF);
	$tempC = round($temperatureC);

	$humidity = $json->main->humidity;
	$wind = $json->wind->speed;
	$cloud = $json->clouds->all;

	$weatherValue = $json->weather[0]->main;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width">
		<meta name="description" content="">
		

		<!-- css -->
		<link rel="stylesheet" type="text/css" href="css/webfontkit-20131209-212244/stylesheet.css">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css">

		<!-- javascript library -->
		 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> <!--jQuery-->
	</head>
	<body>
		<div id="container">
			<!-- Left box -->
			<div id="left-box" class="floatLeft">
				<!-- left box1 -->
				<div id="left-top">
					<div id="margin-top1">
						
						<div id="searchSection">
							<div id="inputBox" class="hidden">
								<form method="post" action="index.php">
									<input type="text" name="city" class="inputForm" placeholder=" city"> 
									<button type="submit" class="searchButton">search</button>
								</form>	
							</div>
							<div id="settingSection">
									<img src="image/setting.png" class="settingButton">
							</div>
						</div>
						
					</div>
					<span class="bigType"><?php echo $city; ?></span><br><br>
					<span class="smallType"><?php echo $weatherValue; ?></span>

				</div>

				<!-- left box2 -->
				<div id="left-bottom1" class="floatLeft">
					<div id="margin-top1"></div>
					<img src="image/icon-01.png" class="resize1"><br><br>
					<span class="mainType"><?php echo $tempF; ?>°F</span>
				</div>

				<!-- left box3 -->
				<div id="left-bottom2" class="floatLeft">
					<div id="margin-top1"></div>
					<img src="image/icon-01.png" class="resize1"><br><br>
					<span class="mainType"><?php echo $tempC; ?>°C</span>
				</div>
			</div>
			<!-- Right box -->
			<div id="right-box" class="floatLeft">
				<!-- right box1 -->
				<div id="right-top">
					<div id="margin-top2"></div>
					<img src="image/icon-02.png" class="resize2"><br><br>
					<span class="mainType"><?php echo $cloud; ?></span>
				</div>

				<!-- right box2 -->
				<div id="right-middle">
					<div id="margin-top2"></div>
					<img src="image/icon-03.png" class="resize2"><br><br>
					<span class="mainType"><?php echo $wind; ?></span>
				</div>

				<!-- right box3 -->
				<div id="right-bottom">
					<div id="margin-top2"></div>
					<img src="image/icon-04.png" class="resize1"><br><br>
					<span class="mainType"><?php echo $humidity; ?>%</span>
				</div>

			</div>

		</div>

	</body>

	<script type="text/javascript">
		$(document).ready(function(){
			$(".settingButton").click(function(){
				$("#inputBox").toggleClass("visible");
			});

			//// input box /////
			//onfocus='blur()'
			$(".inputForm").focus(function(){
				$(this).css("background-color", "rgba(255,255,255,0.5)");
				$(this).css("outline", "none"); // remove bounding box
			});

			$(".searchButton").focus(function(){
				$(this).blur();
			});

		});
	</script>

</html>
