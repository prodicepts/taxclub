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
            <a href="newquestion.php"><img src="taxclub_header.png" alt=""></a>
        </div>
        <div class="congrat" style="display:none;" id="congrat">
                <img src="images/ok.gif" alt="">
            </div>
        <!-- Question and Question Indexes here. -->
        <div class="qandIndex" >
            
            <div class="question"> <!-- Options Pan -->
                <div class="qhead">
                    <h1 >Add New Question</h1>
                    
                </div>
                    
                <div class="qbody">
                    <div class="row">
                    <span id='Response'></span>
                    </div>
                    <form id='qForm' action="nnn.php" method="POST">
                        <div class="row">
                            <label for="round">round</label>
                            <select name="round" id="roundindex" class='txtlbl medium' required>
                                <option value="" selected disabled>Select Round Index</option>
                                <option value="0">Test Round</option>
                                <option value="1">Round I</option>
                                <option value="2">Round II</option>
                                <option value="3">Round III</option>
                                <option value="4">Extra Round</option>
                            </select>
                            <div class='sub-dex'>
                            <label for="nextRound">Round Index : <span id='roundNo'>--</span></label>
                            <label for="nextIndex">Next Index : <span id='nextNo'>--</span></label>
                            </div>
                            <input type="text" name='questionnumber' id='hiddenqn' hidden>
                        </div>

                        

                        <div class="row">
                            <label for="question" id='qst'>Question</label>
                            <textarea name="quest" required></textarea>
                        </div>

                        <div class="row ">
                            <label for="A">Option A</label>
                            <input type="text" class='txtlbl' id='a' name='opta' required>
                            <input type="radio" name="correctAnswer" value='a' class='chkbox'>
                        </div>

                        <div class="row">
                            <label for="B">Option B</label>
                            <input type="text" class='txtlbl' id='b' name='optb' required>
                            <input type="radio" name="correctAnswer" value='b' class='chkbox'>
                        </div>

                        <div class="row">
                            <label for="C">Option C</label>
                            <input type="text" class='txtlbl' id='c' name='optc' required>
                            <input type="radio" name="correctAnswer" value='c' class='chkbox'>
                        </div>

                        <div class="row">
                            <label for="D">Option D</label>
                            <input type="text" class='txtlbl' id='d' name='optd' required>
                            <input type="radio" name="correctAnswer" value='d' class='chkbox'>
                        </div>

                        <div class="row" style="display:none">
                            <label for="E">Option E</label>
                            <input type="text" class='txtlbl' id='answr' name='correctChoice' required >
                        </div>

                        <div class="row ">
                            <button class="btnSend" id="sendForm" name="sendForm">Upload Question</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Options Pan -->
<!--             
                <div class="options" id="options">
                        jj
                </div> -->
        </div>
       

       
    </div>
    <script src="scripts.js"></script>
        <script type="text/javascript">
                
  </script>
    
</body>

</html>