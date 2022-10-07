<?php
	require_once('connect.php');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>2021 Kw-irs Tax Club ScoreBoard</title>
	<link rel="stylesheet" href="style2.css">
	<script src="jqu.js"></script> 
</head>
<body>
    <div class="qwrap">
        <div class="image">
            <!-- <img src="logo.png" alt="logo"> -->
            <img src="images/kwaralogo.png" alt="">
            <a href="screen2.php"><img src="taxclub_header.png" alt=""></a>
        </div>
        <div class="congrat" style="display:none;" id="congrat">
                <img src="images/ok.gif" alt="">
            </div>
        <div class="round-heading" onclick="return confirmAndRedirect();">
            <?php
                if(getNextRound() == 0){
                    echo 'Test Round';
                }else{
                    echo 'Round '.getNextRound();
                }
            ?>
                
            
        </div>
        <?php
            if(isset($_GET['q']) && $_GET['r'] !== NULL){
                updateMasterScreen($_GET['r'], $_GET['q']);
                

                $round = $_GET['r'];
                $questionIndex = $_GET['q'];
                // set that question has been picked in db;
                $sq2 = "UPDATE `qindex` SET `answered` = 1 WHERE `round` = '$round' AND `qnumber` = '$questionIndex'";
                $rss = mysqli_query($mysqli,$sq2);

                //initiate question loads from db
                $sql = "SELECT * FROM `qindex` WHERE `round`= '$round' AND `qnumber` = '$questionIndex'";
                $result = mysqli_query($mysqli,$sql);
                $row = mysqli_fetch_assoc($result);

                //for audit trail, insert question and round index
                // if(QroundExist($round, $questionIndex)){
                //     $sq3 = "INSERT INTO `audittrail`(`audit_id`, `roundindex`, `questionindex`, `school_id`, `score`, `timing`) 
                //         VALUES (NULL,'$round','$questionIndex','','','')";
                //     $ress = mysqli_query($mysqli, $sq3);
                // }
                

        ?>
        
        <!-- Question and Question Indexes here. -->
        <div class="qandIndex" >
            
            <div class="question"> <!-- Options Pan -->
                <div class="qhead">
                    <h1 >Question <?php echo $questionIndex; ?></h1>
                </div>
                    <div class="timer"><span>Time Left</span>
                        <div class="timer-count" id="timer-count">
                        <span id="counting">20s</span>
                        </div>
                    </div>
                <div class="qbody">
                    <span class="qbdy">
                    <?php echo $row['question']; ?>
                    </span>
                </div>
            </div>
            <!-- Options Pan -->
            <div class="optionshield" id="optionshield" >
            </div>
                <div class="options" id="options">
                        <div class="option">
                            <button  class='opt a' id='a' value="<?php echo $row['optiona']; ?>"><div class='optionContainer'>A</div> <span><?php echo $row['optiona']; ?></span></button>
                            
                        </div>

                        <div class="option">
                            <button  id='b' class='opt b' value="<?php echo $row['optionb']; ?>"><div class='optionContainer'>B</div> <span><?php echo $row['optionb']; ?></span></button>
                            
                        </div>

                        <div class="option">
                            <button  class='opt c' id='c' value="<?php echo $row['optionc']; ?>"><div class='optionContainer'>C</div> <span><?php echo $row['optionc']; ?></span></button>
                            
                        </div>
                        
                        <div class="option">
                            <button  class='opt d' id='d' value="<?php echo $row['optiond']; ?>"><div class='optionContainer'>D</div> <span><?php echo $row['optiond']; ?></span></button>
                            
                        </div>
                        <div class="option e" style="display:none;">
                            <button id="answer" value="<?php echo $row['correctanswer']; ?>"></button>
                        </div>
                </div>
        </div>
        <?php
            }else{
        ?>
                <div class="qandIndex"  id="noquestion"> 
                    <div class="image-loader" id="image">
                        <img src="images/loading-buffering.gif" class="img-responsive" />
                        <span>Waiting for Questions...</span>
                    </div>
                </div>
               
        <?php
            }
        ?>
        <audio src="./audios/audio1.mp3" id="my_audio" ></audio>
        <audio src="./audios/audio3.mp3" id="my_audio3" ></audio>
        <audio src="./audios/applause.wav" id="applause" ></audio>
        <audio src="./audios/boo.mp3" id="boo" ></audio>

        <div class="remquestions" id="remquestions">
                
        </div>
        <div class="otherbtns">
                
                        <div class="opbtn nextq">
                <?php
                    if(isset($_GET['q']) && $_GET['r'] !== NULL){
                ?>
                            <button id="nq">Start Timer</button>
                            <button id="e" value="showAnswer" class="opt e" style="margin-right:20px;">Show Answer</button>
                            <!-- <button >END ROUND <?php echo getNextRound(); ?></button> -->
                <?php
                    }
                ?>
                        </div>
                
                        <div class="option toggle">
                            <button class="ts" id="changeScreen">Toggle Screens</button>
                        </div>
        </div>
    </div>
    <script src="scripts.js"></script>
        <script type="text/javascript">
                
  </script>
    
</body>

</html>