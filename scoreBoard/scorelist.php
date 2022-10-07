<?php

require_once('connect.php');
				if(getNextRound() <= 3){
					$sql = "SELECT * FROM `schools` ORDER BY `score` DESC ,`time_entered` ASC";
				}else{
					$sql = "SELECT * FROM `schools` ORDER BY `score` DESC ,`extra` DESC";
				}
				 
				//$sql = "SELECT * FROM (SELECT * FROM `schools` ORDER BY `score` DESC ,`time_entered` ASC ) AS top_100 ORDER BY `extra` DESC";
				//$sql = "SELECT * FROM `schools` ORDER BY `schools`.`score` DESC, `schools`.`time_entered` ASC, `schools`.`extra` DESC";
				//$sql = "SELECT * FROM `schools` ORDER BY `schools`.`score` DESC, `schools`.`time_entered` ASC, `schools`.`extra` ASC, `schools`.`t2` DESC";
				$result = mysqli_query($mysqli,$sql);
				$i = 1;
                $output = "";
				while($row = mysqli_fetch_assoc($result)){
					$scoreInPer = $row['score']/0.3 ."%";
					$sch_name = strtoupper($row['school_names']);
					if($row['sch_id'] == getNextSch()){
						$cls = 'current';
						$cl2 = 'blink';
					}else{
						$cls = '';
						$cl2 = 'hidden';
					}
					if($row['extra'] === NULL){
						$extra = 'additional_pts';
					}else{
						$extra = 'additional_pts_show';
					}
					$point = 'points';
                    $output .= "
			
                <div class=lboard_mem id=lboard_{$i}>
					
					<div class=name_bar>
					<a href=audittrails.php?ref={$row['sch_id']} target=_blank>
						<p> {$row['school_names']} </p>
						<div class=bar_wrap>
							<div class=inner_bar style='width: {$scoreInPer}'></div>
						</div>
					</a>
					</div>
					<div class=points>{$row['score']} </div>
					<span id={$extra}>&nbsp;+&nbsp;{$row['extra']}</span>
					<div class={$cl2}> 
						<img src=images/pointer1.png width=10px height=60px />
					</div>
					
				</div>
				
            
                    ";
					$i++;
				}
                echo $output;
?>




