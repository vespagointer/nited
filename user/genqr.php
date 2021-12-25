<?php
$surl = $_POST["InputData"];

include "../phpqrcode/qrlib.php";

$filename = '../temp/qrcode.png';

QRcode::png($surl, $filename, 'Q', '10', 1);