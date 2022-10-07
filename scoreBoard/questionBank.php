<?php
require_once('connect.php');
$nextQuestionIndex = getNextQuestion();

echo loadQuestion($nextQuestionIndex);



?>