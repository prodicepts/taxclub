<?php
	require_once('connect.php');
        $msg = "";
    
        if(isset($_POST['addFive'])){
            //$sch_id = $_POST['schools'];
            //echo "plus five to ".$_POST['schools'];
            if(empty($_POST['schools'])){
                $msg = "You must select a school to award a point";
            }else {
                $sch_id = $_POST['schools'];
                $currScore = getCurrentScore($sch_id);
                $currScore += 2;
                $sql_1 = "UPDATE `schools` SET `score`= '$currScore', `time_entered` = CURRENT_TIMESTAMP() WHERE `sch_id`= '$sch_id'";
                $res_1 = mysqli_query($mysqli, $sql_1);
                if($res_1){
                    
                    auditScores(2, $sch_id);
                    $msg = " 2 Points Added for ".getSchoolName($sch_id);
                }
            }
            
        }
        if(isset($_POST['removeFive'])){
            //echo "plus five to ".$_POST['schools'];
            if(empty($_POST['schools'])){
                $msg = "You must select a school to award point";
            }else {
                $sch_id = $_POST['schools'];
                $currScore = getCurrentScore($sch_id);
                $currScore -= 2;
                $sql_1 = "UPDATE `schools` SET `score`= '$currScore' WHERE `sch_id`= '$sch_id'";
                $res_1 = mysqli_query($mysqli, $sql_1);
                if($res_1){
                    //
                    auditScores(-2, $sch_id);
                    $msg = " 2 Points Removed for ".getSchoolName($sch_id);
                }
            }
        }

        if(isset($_POST['awardzero'])){
            if(empty($_POST['schools'])){
                $msg = "You must select a school to award a point";
            }else {
                $sch_id = $_POST['schools'];
                auditScores(0, $sch_id);
                $msg = " 0 Points awarded for ".getSchoolName($sch_id);
            }
        }
        if(isset($_POST['setSchool'])){
            $val = $_POST['schools'];
            $sql = "UPDATE `currentschool` SET `sch_id`='$val' WHERE `id` = 1";
            $res_1 = mysqli_query($mysqli, $sql);
        }
        if(isset($_POST['setRound'])){
            $val = $_POST['sele2'];
            $sql = "UPDATE `nextquest` SET `nextquestindex`='$val' WHERE `id` = 1";
            $res_1 = mysqli_query($mysqli, $sql);
            if($res_1){
                //echo "Round set to ". $val;
                if($val > 3){
                    $sql_rep = "UPDATE `currentschool` SET `sch_id`=0";
                    mysqli_query($mysqli, $sql_rep);
                }
            }
        }
        if(isset($_POST['reset'])){
            resetAll();
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>2021 Kw-irs Tax Club ScoreBoard</title>
	<link rel="stylesheet" href="styles.css">
    <script src="jqu.js"></script>  
</head>
<body>

<div class="wrapper">
	<div class="image">
		<img src="logo.png" alt="logo">
		
	</div>
	<div class="headline">
	<p>2021 Tax Club Game ScoreBoard</a></p>
	</div>
	<div class="lboard_section">
		<div class="lboard_tabs">
			<div class="tabs">
				<ul>
					<p>Score Input  :: </p>
                    <div><span>Current Round is<?php echo " ".getNextRound(); ?></span><br>
                    <span>Current School is:
                        <?php 
                            if(getNextSch() <= 0){
                                echo "You Decide which school is next";
                            }else{
                                echo getSchoolName(getNextSch());
                            }
                        ?></span></div>
				</ul>
			</div>
		</div>

		<div class="lboard_wrap">
			
			<div class="lboard_item scoreboard" style="display: block;">
                    <form action="scoreInput.php" method="post">
                        <?php
                            if(getNextRound() > 0){
                        ?>
                        <div class="form-data">
                                <select name="schools" id="sele" >
                                    <option value="" selected disabled>Select School</option>
                                    <?php
                                        $sql = "SELECT * FROM `schools` ORDER BY `school_names` ASC";
                                        $result = mysqli_query($mysqli,$sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                        <option value="<?php echo $row['sch_id']; ?>"><?php echo $row['school_names'];?></option>
                                    <?php

                                        }
                                    ?>
                                </select>
                                <div class="btn_clickables">
                                    <!-- <button  id="btn" onclick="" name="addFive">[+] Add 2</button>
                                    <button name="removeFive">[-] Subtract 2</button>
                                    <br><br>
                                    <button name="awardzero">[+0] Award 0</button> -->
                                    <button  id="btn"  name="setSchool">Set School</button>
                                </div>
                        </div>
                        <?php
                            }else{
                        ?>
                            <div class="form-data">
                                <div class="btn_clickables">
                                    <button id="" name="reset">Reset ScoreBoard</button>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                        <div class="form-data">
                        <select name="sele2" id="questIndex">
                                    <option value="">Set Round</option>
                                    <option value="0">Test Round</option>
                                    <option value="1">Round I</option>
                                    <option value="2">Round II</option>
                                    <option value="3">Round III</option>
                                    <option value="4">Round IV</option>
                                    
                                </select>
                                <div class="btn_clickables">
                                    <button id="" name="setRound">Set Round</button>
                                </div>
                        </div>
                    </form>
			
				
			</div>
		</div>
	</div>
	
</div>	
<div class="footer">Designed and Maintained by KW-IRS ICTeam &nbsp;&copy; <?php echo date('Y'); ?></div>
<script src="scripts.js"></script>
</body>
</html>