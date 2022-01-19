<?php
$thai = array("๐", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙");
$arabic = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

$text = "formonet๖๔";
$text = str_replace($thai, $arabic, $text);

echo $text;
