<?php 
	/**
	 *  Db
	 */
	$DB_NAME = 'scoreboarding';
	$DB_HOST = 'localhost';
	$DB_USER = 'root';
	$DB_PASS = '';	
	$mysqli = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS,$DB_NAME);
	
	function getSchoolName($id){
		global $mysqli;
		$sql = "SELECT * FROM `schools` WHERE `sch_id` = '$id'";
		$res = mysqli_query($mysqli, $sql);
		$row = mysqli_fetch_assoc($res);
		return $row['school_names'];
	}
	
	function getCurrentScore($id){
		global $mysqli;
		$sql = "SELECT * FROM `schools` WHERE `sch_id` = '$id'";
		$res = mysqli_query($mysqli, $sql);
		$row = mysqli_fetch_assoc($res);
		return $row['score'];
	}
	
	function getCurrScoreExtra($id){
		global $mysqli;
		$sql = "SELECT * FROM `schools` WHERE `sch_id` = '$id'";
		$res = mysqli_query($mysqli, $sql);
		$row = mysqli_fetch_assoc($res);
		return $row['extra'];

	}
	
	function getNextRound(){
		global $mysqli;
		$sql = "SELECT * FROM `nextquest` WHERE `id` = 1";
		$res = mysqli_query($mysqli, $sql);
		$row = mysqli_fetch_assoc($res);
		return $row['nextquestindex'];
	}
	function getNextSch(){
		global $mysqli;
		$sql = "SELECT * FROM `currentschool` WHERE `id` = 1";
		$res = mysqli_query($mysqli, $sql);
		$row = mysqli_fetch_assoc($res);
		return $row['sch_id'];
	}
	
	
	function loadQuestion($id){
		global $mysqli;
		$sql = "SELECT * FROM `questionindex` WHERE `qnumb` = '$id'";
		$res = mysqli_query($mysqli, $sql);
		$count = mysqli_num_rows($res);
		if($count > 0){
			$row = mysqli_fetch_assoc($res);
			if($row['question']){
				return $row['question'];
			}return "<h3 style=text-align:center>Select a question Index from the Question Bank</h3>";
		}
		return "<div class=\"image-loader\" id=\"image\">
		<img src=\"images/loading-buffering.gif\" class=\"img-responsive\" />
		<span>Waiting for Questions...</span>
	</div>";
		
	}

	function QroundExist($r, $q){  //get if question exist and creates no duplicate
		global $mysqli;
		$sql = "SELECT * FROM `audittrail` WHERE `roundindex` = '$r' AND `questionindex` = '$q'";
		$res = mysqli_query($mysqli, $sql);
		$count = mysqli_num_rows($res);
		if($count > 0){
			return false;
		}return true;
	}

	function getNextLine(){ //get the last entry for the audit trail.
		global $mysqli;
		$sql = "SELECT * FROM `audittrail` ORDER BY `audit_id` DESC LIMIT 1";
		$res = mysqli_query($mysqli, $sql);
		$row = mysqli_fetch_assoc($res);
			return $row['audit_id'];
	}
	
	function updateNextSchool(){
		global $mysqli;
		$currSch = getNextSch() + 1;
		if($currSch > 6){
			$currSch = 1;
		}
		$sql = "UPDATE `currentschool` SET `sch_id`='$currSch' WHERE `id`='1'";
		mysqli_query($mysqli, $sql);
	}

	
	function updateNextR4(){
		global $mysqli;
		$sql = "UPDATE `currentschool` SET `sch_id`= 0 WHERE `id`='1'";
		mysqli_query($mysqli, $sql);

	}

	function auditScores($round, $questionIndex, $score, $sch_id){
		global $mysqli;
		$sq3 = "INSERT INTO `audittrail`(`audit_id`, `roundindex`, `questionindex`, `school_id`, `score`, `timing`) 
        		VALUES (NULL,'{$round}','{$questionIndex}','{$sch_id}','$score', CURRENT_TIMESTAMP())";
        $ress = mysqli_query($mysqli, $sq3);
		
	}


	function returnTable($round, $sch_id){
		global $mysqli;
		$output ="<table>
					<tr>
					<th>SN</th>
					<th>Questions</th>
					<th>Points</th>
					<th>Time</th>
					</tr>";
					$i = 1;
		$sql_round_I = "SELECT * FROM `audittrail` WHERE `roundindex`= '{$round}' AND `school_id` = '{$sch_id}'";
		$result = mysqli_query($mysqli,$sql_round_I);
		
		while($row = mysqli_fetch_assoc($result)){
			//$img = 'images/correct.png';
			// if($row['score'] === 2){
			// 	$img = 'images/correct.png';
			// }
			// if($row['score'] === 0){
			// 	$img = 'images/wrong.png';
			// }
		$output .= "<tr>
						<td>$i</td>
						<td> $row[questionindex]</td>
						<td> $row[score]</td>
						<td>$row[timing]</td>
					</tr>";
			$i++;
		}
		$output .= "</table>";
		return $output;
	}

	function getTotalScore($sch_id){
		global $mysqli;
		$sql = "SELECT sum(`score`) AS `spr` FROM `audittrail` WHERE  `school_id` = '{$sch_id}' AND `roundindex` < '4'";
		$res = mysqli_query($mysqli, $sql);
		$row = mysqli_fetch_assoc($res);
		return ($row['spr'])? $row['spr']: '0';
	}
	function getScorePerRound($sch_id, $round = ""){
		global $mysqli;
		if($round < 4){
			$sql = "SELECT sum(`score`) AS `spr` FROM `audittrail` WHERE `roundindex` = '{$round}' AND `school_id` = '{$sch_id}'";
		}else{
			$sql = "SELECT sum(`score`) AS `spr` FROM `audittrail` WHERE `roundindex` = '4' AND `school_id` = '{$sch_id}'";
		}
		// else
		// {
		// 	$sql = "SELECT sum(`score`) AS `spr` FROM `audittrail` WHERE  `school_id` = '{$sch_id}' AND `roundindex` < '4'";
		// }
		
		$res = mysqli_query($mysqli, $sql);
		$row = mysqli_fetch_assoc($res);
		// if($round){
		// 	return ($row['spr'])? $row['spr']: '-';
		// }
		// return ($row['spr'])? $row['spr']: '0';
		if($row['spr'] === NULL){
			return '-';
		}else{
			return ($row['spr'])? $row['spr']: '0';
		}
		
	}

	function checkExtra($sch_id){
		global $mysqli;
		$sql = "SELECT * FROM `audittrail` WHERE `school_id` = '$sch_id' AND `roundindex` = 4";
		$res = mysqli_query($mysqli, $sql);
		$count = mysqli_num_rows($res);
		if($count > 0){
			return true;
		}return false;
	}
	
	function resetAll(){
		global $mysqli;
		$sql_1 = "UPDATE `qindex` SET `answered`='0'";
		$sql_2 = "UPDATE `schools` SET `score`='0',`time_entered`= CURRENT_TIMESTAMP(),`extra`= NULL,`t2`= NULL ";
		$sql_3 = "UPDATE `nextquest` SET `nextquestindex`=1";
		$sql_4 = "UPDATE `currentschool` SET `sch_id`=1";
		$sql_5 = "DELETE FROM `audittrail`";
		$sql_arr = [$sql_1, $sql_2, $sql_3, $sql_4, $sql_5];
		foreach ($sql_arr as $query){
			mysqli_query($mysqli, $query);
		}
	}
	// function checkychecky(){
	// 	$c_sch = "Current School is:";
	// 	if(getNextSch() <= 0){
	// 		$c_sch += "You Decide which school is next";
	// 	}else{
	// 		$c_sch += getSchoolName(getNextSch());
	// 	}	
	// 	echo $c_sch;
	// }
	function sessionAlert($msg,$link='newquestion'){
		$x = '<script type="text/javascript">alert("' . $msg . '")</script>';
		echo $x;          
			  if (isset($x)) {          
			  echo '<script type="text/javascript"> window.location.href = "' . $link . '"; </script>';         
				}
	}

	function updateMasterScreen($round, $qindex){
		global $mysqli;
		$sql = "UPDATE `masterscreen` SET `round`='$round',`qnumber`='$qindex' WHERE `id` = 1";
		mysqli_query($mysqli, $sql);
	}

	function getCurrIndexMaster(){
		global $mysqli;
		$sql = "SELECT * FROM `masterscreen` WHERE `id` = 1";
		$res = mysqli_query($mysqli, $sql);
		$row = mysqli_fetch_assoc($res);
		return $row['qnumber'];
	}
	function getMaterRound(){
		global $mysqli;
		$sql = "SELECT * FROM `masterscreen` WHERE `id` = 1";
		$res = mysqli_query($mysqli, $sql);
		$row = mysqli_fetch_assoc($res);
		return $row['round'];
	}
?>