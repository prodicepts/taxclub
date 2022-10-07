<?php
	require_once('connect.php');
    if(isset($_GET['r']) && isset($_GET['q'])){
        //if($_GET['r'] <= 0){
        $nextSchIndex = getNextSch();
        $nextRound = getNextRound();
        if($nextRound <= 0){
            $sch_id = $nextSchIndex;
            $roundIndex = $_GET['r'];
            $qindex = $_GET['q'];
            $currScore = getCurrentScore($sch_id);
            $currScore += 0;
            $sql_1 = "UPDATE `schools` SET `score`= '$currScore', `time_entered` = CURRENT_TIMESTAMP() WHERE `sch_id`= '$sch_id'";
            $res_1 = mysqli_query($mysqli, $sql_1);
            if($res_1){
                updateNextSchool();
            }
        }elseif(($nextRound > 0) && ($nextRound <= 3)){
                $sch_id = $nextSchIndex;
                $roundIndex = $_GET['r'];
                $qindex = $_GET['q'];
                $currScore = getCurrentScore($sch_id);
                $currScore += 0;
                $sql_1 = "UPDATE `schools` SET `score`= '$currScore', `time_entered` = CURRENT_TIMESTAMP() WHERE `sch_id`= '$sch_id'";
                $res_1 = mysqli_query($mysqli, $sql_1);
                if($res_1){
                    updateNextSchool();
                    auditScores($roundIndex, $qindex, 0, $sch_id);
                    
                }
        }elseif($nextRound >= 4){
                $sch_id = $nextSchIndex;
                $roundIndex = $_GET['r'];
                $qindex = $_GET['q'];
                $currScore = getCurrScoreExtra($sch_id);
                $currScore += 0;
                $date = date('Y-m-d H:i:s');
                $sql_1 = "UPDATE `schools` SET `extra`= '$currScore', `t2` = '$date' WHERE `sch_id`= '$sch_id'";
                $res_1 = mysqli_query($mysqli, $sql_1);
                if($res_1){
                    auditScores($roundIndex, $qindex, 0, $sch_id);
                    updateNextR4();
                }
        }
        
    }
    

?>