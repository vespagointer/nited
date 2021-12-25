<?php
$file = "../files/2564/book6_25641208091213_0.pdf";
if (unlink($file)) {
 echo "xx";
} else {
 echo "FU";
}