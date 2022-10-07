<?php
	require_once('connect.php');
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Score card For <?php echo getSchoolName($_GET['ref']); ?></title>
    <link rel="stylesheet" href="sty.css">
    <script src="jqu.js"></script>  
</head>
<body>
    <div class="header">
        <div class="images">
            <img src="images/kwaralogo.png" alt="">
        <img src="taxclub_header.png" alt="">
        </div>
            
    </div>
    <div class="scorecard-wrapper">
        <div class="schoolinfo">
                <p>School Name : <?php echo getSchoolName($_GET['ref']); ?></p>
        </div>
        <div class="scoreinfo">
            <!-- round 1-->
            <div class="round">
                <div class="round-heading">
                    <span>Round I</span>
                </div>
                <div class="round-body">
                <?php echo returnTable(1, $_GET['ref']); ?>
                </div>
            </div>
            <!-- round 2 -->
            <div class="round">
                <div class="round-heading">
                <span>Round II</span>
                </div>

                <div class="round-body">
                <?php echo returnTable(2, $_GET['ref']); ?>
                </div>
            </div>
            <!-- round 3 -->
            <div class="round">
                <div class="round-heading">
                <span>Round III</span>
                </div>

                <div class="round-body">
                        <?php echo returnTable(3, $_GET['ref']); ?>

                </div>
            </div>

            <?php 
                if(checkExtra($_GET['ref'])){
            ?>
            <!-- round 4 -->
            <div class="round">
                <div class="round-heading">
                <span>Round IV</span>
                </div>

                <div class="round-body">
                        <?php echo returnTable(4, $_GET['ref']); ?>

                </div>
            </div>
            <?php
                }
            ?>

        </div>
    </div>
    <div class="footer">

    </div>

<script src="scripts.js"></script>
</body>
</html>