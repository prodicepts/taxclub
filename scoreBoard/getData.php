<?php 

    require_once('connect.php');
	if (isset($_POST['round'])) {
		
		//$sqlFetch = "SELECT * FROM `staff_login` WHERE `privilege` = 4 AND `directorate` = '$_POST[directorate]'";
        $sqlFetch = "SELECT * FROM `qindex` WHERE `round` = '$_POST[round]' ORDER BY `qnumber` DESC LIMIT 1";
		$res = mysqli_query($mysqli,$sqlFetch);
		if(mysqli_num_rows($res) == 0){
            echo 1;
        }else{
            $row = mysqli_fetch_assoc($res);
            $lastindex = $row['qnumber'];
            $next = $lastindex + 1;
            echo $next;
        }
	}


 
?>