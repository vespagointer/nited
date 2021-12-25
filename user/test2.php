<?php

$tmpschool = $_POST["school"][0];
//var_dump($tmpschool);
$school = implode(",", $tmpschool);
echo $school;