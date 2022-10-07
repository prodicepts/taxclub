<?php
	require_once('connect.php');
    $sql_bd = "SELECT * FROM `schools` ORDER BY `score` DESC ,`extra` DESC";
    $res = mysqli_query($mysqli, $sql_bd);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <script src="jqu.js"></script>  
    <title>BreakDown By Schools per rounds</title>
</head>
<body>
<div class="header">
        <div class="images">
            <img src="images/kwaralogo.png" alt="">
        <a href="screen2.php"><img src="taxclub_header.png" alt=""></a>
        </div>   
</div>
    <div class="breakdown-body">
            <div class="breakheader">
                    Scoresheets BreakDown
            </div>
            <div class="bdy">
                <div class="colum">
                        <table width="100%">
                            <thead>
                                <tr>
                                <th width="20%">Schools</th> <th>Round I</th> <th>Round II</th> <th>Round III</th><th>Total</th><th>Extra </th>
                                </tr>
                            </thead>
                    <?php
                        while($row = mysqli_fetch_assoc($res)){
                            if(getScorePerRound($row['sch_id'], 4) != '-'){
                                // $bgcolor = 'red';
                                // $txtcolor = 'white';
                                $style = "background-color:red; color: white; font-size: 2.2em;";
                            }else{
                                $bgcolor = '';
                                $txtcolor = '';
                            }
                    ?>
                    
                            <tr class="rowy">
                                <td class='first'><?php echo $row['school_names']; ?></td>
                                <td><?php echo getScorePerRound($row['sch_id'], 1); ?></td>
                                <td><?php echo getScorePerRound($row['sch_id'], 2); ?></td>
                                <td><?php echo getScorePerRound($row['sch_id'], 3); ?></td>
                                <td style="font-size: 2.1em;"><?php echo getTotalScore($row['sch_id']); ?></td>
                                <!-- <td style="font-size: 1.9em;background-color: <?php echo $bgcolor; ?>;color: <?php echo $txtcolor; ?>"> -->
                                <td style="<?php echo $style; ?>">
                                    <?php 
                                    echo getScorePerRound($row['sch_id'], 4);
                                    
                                    ?>
                                </td>
                            </tr>

                    <?php
                        }
                    ?>
                        </table>
                </div>
                
            </div>
    </div>
<script src="scripts.js"></script>
</body>
</html>