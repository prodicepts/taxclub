<?php

require_once('connect.php');
                $currentRound = getMaterRound();
                $currentIndex = getCurrIndexMaster();
				$sql = "SELECT * FROM `qindex` WHERE `round`= '$currentRound' AND `qnumber` = $currentIndex";
				$result = mysqli_query($mysqli,$sql);
                //$i = 1;
                $output = "";
				while($row = mysqli_fetch_assoc($result)){
					$qindex = $row['qnumber'];
                    $questionbody = $row['question'];
                    $optA =$row['optiona'];
                    $optB =$row['optionb'];
                    $optC =$row['optionc'];
                    $optD =$row['optiond'];
                    $optE =$row['correctanswer'];
                   
                    $class = "<div class='question'>
                    <div class='qhead'>
                        <h1 >Round {$currentRound}, Question {$qindex}</h1>
                    </div>
                        
                    <div class='qbody'>
                        <span class='qbdy'>
                        {$questionbody}
                        </span>
                    </div>
                </div>
                <!-- Options Pan -->
                <div class='optionshield' id='optionshield' >
                </div>
                    <div class='options' id='options'>
                            <div class='option'>
                                <button  class='opt a' id='a'><div class='optionContainer'>A</div> <span>{$optA}</span></button>
                                
                            </div>
    
                            <div class='option'>
                                <button  class='opt a' id='a'><div class='optionContainer'>B</div> <span>{$optB}</span></button>
                                
                            </div>
    
                            <div class='option'>
                                <button  class='opt a' id='a'><div class='optionContainer'>C</div> <span>{$optC}</span></button>
                                
                            </div>
                            
                            <div class='option'>
                                <button  class='opt a' id='a'><div class='optionContainer'>D</div> <span>{$optD}</span></button>
                                
                            </div>

                            
                            
                    </div>
                                
                                ";
                    $output .= $class;
				}
                echo $output;
?>




