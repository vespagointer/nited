<?php
$school = $_POST["school"];
$nOrder = $_POST["nOrder"];
//echo $nOrder;
$sc = array("A", "b");
if ($_POST["v"] == 2) {
 $sc = $school;
} else {
 $sc = explode("\n", str_replace("\r", "", $school));
}

$sc_list = [
 "ศรีสวัสดิ์วิทยาคารจังหวัดน่าน",
 "สตรีศรีน่าน",
 "บ่อสวกวิทยาคาร",
 "น่านประชาอุทิศ",
 "แม่จริม",
 "บ้านหลวง",
 "นาน้อย",
 "ปัว",
 "ศรัทธาศิลาเพชรรังสรรค์",
 "เมืองแงง",
 "มัธยมป่ากลาง",
 "ท่าวังผาพิทยาคม",
 "สารธรรมวิทยาคาร",
 "หนองบัวพิทยาคม",
 "เมืองยมวิทยาคาร",
 "สา",
 "สาธุกิจประชาสรรค์ รัชมังคลาภิเษก",
 "สารทิศพิทยาคม",
 "ทุ่งช้าง",
 "เชียงกลาง\"ประชาพัฒนา\"",
 "พระธาตุพิทยาคม",
 "นาหมื่นพิทยาคม",
 "เมืองลีประชาสามัคคี",
 "สันติสุขพิทยาคม",
 "บ่อเกลือ",
 "ไตรเขตประชาสามัคคี รัชมังคลาภิเษก",
 "น่านนคร",
 "ศรีนครน่าน",
 "มัธยมพระราชทานเฉลิมพระเกียรติ",
 "นันทบุรีวิทยา ในพระบรมราชานุเคราะห์",
];
/*
$sc = [
"ศรีสวัสดิ์วิทยาคารจังหวัดน่าน",
"สตรีศรีน่าน",
"บ่อสวกวิทยาคาร",
"น่านประชาอุทิศ",
"แม่จริม",
"บ้านหลวง",
"นาน้อย",
"ปัว",
"ศรัทธาศิลาเพชรรังสรรค์",
"เมืองแงง",
"เมืองแงง",
];
 */
$sc = array_unique($sc);

$result = array_diff($sc_list, $sc);
//var_dump($sc);
if ($nOrder == 1) {
 foreach ($result as $value) {
  $i++;
  echo "$i. $value <br />\n";
 }
} else {
 foreach ($result as $value) {
  echo "$value <br />\n";
  //echo '&#60;div class="form-check"&#62;<br />';
  //echo '&#60;input class="form-check-input" type="checkbox" name="school" id="SchoolName" value="' . $value . '"&#62;<br />';
  //echo '&#60;label class="form-check-label" for="SchoolName"&#62;' . $value . '&#60;/label&#62;<br />&#60;/div&#62;<br /><br />';
 }
}