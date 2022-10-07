<?php
	require_once('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo date('Y'); ?> Kw-irs Tax Club ScoreBoard</title>
	<link rel="stylesheet" href="styles.css">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>   -->
	<script src="jqu.js"></script> 
</head>
<body>

<div class="wrapper">
	<div class="image">
		<img src="images/kwaralogo2.png" alt="logo">
		<img src="images/taxclub_header2.png" alt="">
		
	</div>
	<div class="headline">
	<p><?php echo date('Y'); ?> Tax Club ScoreBoard</p>
	</div>
	<div class="lboard_section">
		<div class="lboard_tabs">
			<div class="tabs">
				<ul>
					<!-- <p><button id="changescreen" name="question">Next Question</button></p> -->
					<p>ScoreBoard</p>
				</ul>
				<div class="marq"><marquee behavior="" direction="">Designed By KW-IRS. </marquee></div>
			</div>
		</div>

		<!-- <div class="questionFrame" id="questionFrame">
		
		</div> -->
		<div class="lboard_wrap">
			
			<div class="lboard_item scoreboard" style="display: block;" id="scorelist">
			</div>
		</div>
	</div>
	
</div>	
<div class="footer">Designed and Maintained by KW-IRS &nbsp;&copy; <?php echo date('Y'); ?></div>

<script src="scripts.js"></script>

</body>
</html>