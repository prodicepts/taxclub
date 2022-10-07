<?php
	require_once('connect.php');
    //if(isset($_POST['correctChoice'])){
      if(isset($_POST['sendForm'])){
          
        $round = mysqli_real_escape_string($mysqli,trim($_POST['round']));
        $qno = mysqli_real_escape_string($mysqli,trim($_POST['questionnumber']));
        $quest = mysqli_real_escape_string($mysqli,trim($_POST['quest']));
        $opta = mysqli_real_escape_string($mysqli,trim($_POST['opta']));
        $optb = mysqli_real_escape_string($mysqli,trim($_POST['optb']));
        $optc = mysqli_real_escape_string($mysqli,trim($_POST['optc']));
        $optd = mysqli_real_escape_string($mysqli,trim($_POST['optd']));
        $opte = mysqli_real_escape_string($mysqli,trim($_POST['correctChoice']));
        
        if($round == "" || $qno == "" || $quest == "" || $opta == "" || $optb == "" || $optc == "" || $optd == "" || $opte == ""){
            echo "Ensure no field is empty";
        }else{
            $sql = "INSERT INTO `qindex`(`id`, `qnumber`, `question`, `optiona`, `optionb`, `optionc`, `optiond`, `correctanswer`, `answered`, `round`) 
                VALUES (NULL,'$qno','$quest','$opta','$optb','$optc','$optd','$opte','0','$round')";
            $result = mysqli_query($mysqli, $sql);
            if($result){
                
                $msg = "Round {$round} , Question {$qno} Inserted Correctly";
                sessionAlert($msg,$link='newquestion');
            }else{
                $msg = "Error Inserting Question";
                //$msg = $mysqli -> error;
                sessionAlert($msg,$link='newquestion');
            }
        }


        
       
    }
?>