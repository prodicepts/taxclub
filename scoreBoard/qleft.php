<?php

require_once('connect.php');
                $currentRound = getNextRound();
				$sql = "SELECT * FROM `qindex` WHERE `round`= '$currentRound' ORDER BY `qnumber` ASC";
				$result = mysqli_query($mysqli,$sql);
                $i = 1;
                $output = "";
                $outPutArray = array();
				while($row = mysqli_fetch_assoc($result)){
					$availIndex = $row['qnumber'];
                    if($row['answered'] == 1){
                        $class = "<div><span class= 'disabled' >{$availIndex}</span><span class='cross'>X</span></div>";
                        //array_push($outPutArray,$class);
                    }else{
                        $class = "<button class='btn' onclick=location.href='screen2.php?r={$currentRound}&q={$availIndex}'><span >{$availIndex}</span></button>";
                        //array_push($outPutArray,$class);
                    }
                    $i++;
                    array_push($outPutArray,$class);
                    $output .= $class;
				}
                $shuffledArray = shuffle($outPutArray);
                //print_r($outPutArray);
                foreach($outPutArray as $arr){
                    echo $arr;
                }
                //echo $output;
?>




